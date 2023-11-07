<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Object\DynamicConstructor;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\Mapper\Tree\Message\Messages;
use CuyZ\Valinor\MapperBuilder;
use InvalidArgumentException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\InMemoryStorage;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\TokenStorageInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidAccessTokenException;
use SimplyStream\TwitchApiBundle\Helix\Models\AbstractModel;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\Conditions;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Stringable;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function json_decode;

class ApiClient implements ApiClientInterface
{
    use LoggerTrait, LoggerAwareTrait;

    public function __construct(
        protected HttpClientInterface $client,
        protected TwitchProvider $twitch,
        protected MapperBuilder $mapperBuilder,
        protected array $options = [],
        protected TokenStorageInterface $tokenStorage = new InMemoryStorage()
    ) {
        if (! empty($this->options['token'])) {
            foreach ($this->options['token'] as $grant => $token) {
                $this->tokenStorage->save($grant, new AccessToken([
                    'access_token' => $token['token'],
                    'expires_in' => $token['expires_in'],
                    'token_type' => $token['token_type'],
                ]));
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function sendRequest(
        UriInterface $uri,
        string $type = null,
        string $method = 'GET',
        ?AbstractModel $body = null,
        ?AccessTokenInterface $accessToken = null,
        array $headers = []
    ): ?TwitchResponseInterface {
        if (! $accessToken) {
            $accessToken = $this->getAccessToken('client_credentials');
        }

        $response = $this->client->request($method, $uri, [
            'json' => $body?->toArray(),
            'headers' => array_merge($headers, [
                'Authorization' => ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken(),
                'Content-Type' => 'application/json',
                'Client-ID' => $this->options['clientId'],
            ]),
        ]);
        $responseContent = $response->getContent(false);

        if ($response->getStatusCode() >= 400) {
            $error = json_decode($responseContent, false, 512, JSON_THROW_ON_ERROR);
            $this->error($error->message, ['response' => $responseContent]);
            throw new InvalidArgumentException(sprintf('Error from API: "(%s): %s"', $error->error, $error->message));
        }

        if ($response->getStatusCode() === 204) {
            return null;
        }

        try {
            $source = Source::json($responseContent);
            return $this->mapperBuilder
                ->registerConstructor(
                    #[DynamicConstructor]
                    function (string $className, array $value): Subscription {
                        // @TODO: Check if it makes sense to create different Subscriptions instead of Conditions
                        //        Conditions will then be a strict array thats integrity is checked by the mapper (or subscription code)
                        $type = Conditions::MAP[$value['type']];

                        return new Subscription(
                            $value['id'],
                            $value['status'],
                            $value['type'],
                            $value['version'],
                            new $type(...$value['condition']),
                            new \DateTimeImmutable($value['createdAt']),
                            new Transport(...$value['transport'])
                        );
                    }
                )
                ->allowPermissiveTypes()
                ->allowSuperfluousKeys()
                ->mapper()->map($type, $source->camelCaseKeys());
        } catch (MappingError $mappingError) {
            $messages = Messages::flattenFromNode($mappingError->node())->errors();
            foreach ($messages as $message) {
                $this->log($message, LogLevel::ERROR);
            }

            throw $mappingError;
        }
    }

    /**
     * @param string $grant
     *
     * @return AccessTokenInterface
     */
    protected function getAccessToken(string $grant): AccessTokenInterface {
        if ($this->tokenStorage->has($grant)) {
            return $this->tokenStorage->get($grant);
        }

        $accessToken = null;

        try {
            $accessToken = $this->twitch->getAccessToken($grant);
        } catch (IdentityProviderException $e) {
            throw new InvalidAccessTokenException($accessToken, $e->getMessage());
        }

        return $accessToken;
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, Stringable|string $message, array $context = []): void {
        $this->logger?->log($level, $message, $context);
    }

    /**
     * @param TokenStorageInterface $tokenStorage
     *
     * @return $this
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage): self {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }
}

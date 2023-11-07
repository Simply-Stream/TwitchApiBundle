<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use CuyZ\Valinor\Mapper\MappingError;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Nyholm\Psr7\Uri;
use SimplyStream\TwitchApiBundle\Helix\Models\AbstractModel;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @template T
 */
abstract class AbstractApi
{
    public function __construct(protected ApiClient $apiClient) {
    }

    /**
     * @param string                    $path
     * @param array                     $query
     * @param string|null               $type
     * @param string                    $method
     * @param array                     $headers
     * @param AbstractModel|null        $body
     * @param AccessTokenInterface|null $accessToken
     *
     * @return T|null
     * @throws MappingError
     * @throws \JsonException
     */
    protected function sendRequest(
        string $path,
        array $query = [],
        string $type = null,
        string $method = Request::METHOD_GET,
        array $headers = [],
        ?AbstractModel $body = null,
        ?AccessTokenInterface $accessToken = null
    ): ?TwitchResponseInterface {
        $uri = new Uri(ApiClientInterface::BASE_API_URL . $path);

        return $this->apiClient->sendRequest(
            $uri->withQuery($this->buildQueryString($query)), $type, $method, $body, $accessToken, $headers
        );
    }

    /**
     * This function will build the query string the way twitch requires it
     *
     * @param array $query
     *
     * @return array|string|string[]|null
     */
    private function buildQueryString(array $query) {
        // Remove empty values and put everything together
        $queryString = http_build_query(array_filter($query));

        return preg_replace('/%5B(?:\d|[1-9]\d+)%5D=/', '=', $queryString);
    }
}

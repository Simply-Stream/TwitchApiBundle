<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\Authentication\Provider;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use League\OAuth2\Client\Grant\AbstractGrant;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\OidcAccessToken;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\Authentication\Provider
 */
class TwitchProvider extends GenericProvider
{
    /**
     * @inheritDoc
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://id.twitch.tv/oauth2/authorize';
    }

    /**
     * @inheritDoc
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://id.twitch.tv/oauth2/token';
    }

    /**
     * Returns the URL for requesting public keys to verify JWT signature
     *
     * @return string
     *
     * @TODO: @see https://github.com/Strobotti/php-jwk to parse public key
     */
    public function getPublicKeysUrl()
    {
        return 'https://id.twitch.tv/oauth2/keys';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultScopes()
    {
        return ['openid'];
    }

    /**
     * @inheritDoc
     *
     * @return string Scope separator, defaults to ' '
     */
    protected function getScopeSeparator()
    {
        return ' ';
    }

    /**
     * @inheritDoc
     */
    protected function createAccessToken(array $response, AbstractGrant $grant): AccessTokenInterface
    {
        return new OidcAccessToken($response);
    }

    /**
     * @inheritDoc
     */
    protected function getAuthorizationParameters(array $options)
    {
        // response_type has been hardcoded in parent class and will be overridden by the parent::getAuthorizationParameters() call.
        // For twitch/oidc, we can also use token, id_token and token+id_token, to let the frontend handle twitchs response.
        $responseType = $options['response_type'] ?? 'code';

        $options = parent::getAuthorizationParameters($options);
        unset($options['approval_prompt']);
        $options['response_type'] = $responseType;

        return $options;
    }

    protected function fetchResourceOwnerDetails(AccessToken $token)
    {
        $resourceOwnerDetails = parent::fetchResourceOwnerDetails($token);
        $keyset = $this->getPublicKeyset();

        return \array_merge(
            $resourceOwnerDetails,
            (array)JWT::decode($token->getValues()['id_token'], $keyset, ['RS256'])
        );
    }

    protected function getPublicKeyset()
    {
        $factory = $this->getRequestFactory();
        $request = $factory->getRequest(Request::METHOD_GET, $this->getPublicKeysUrl());
        $jwk = $this->getResponse($request);

        return JWK::parseKeySet((string)$jwk->getBody());
    }
}

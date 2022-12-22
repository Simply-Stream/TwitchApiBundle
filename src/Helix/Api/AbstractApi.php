<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use Nyholm\Psr7\Uri;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractApi
{
    public function __construct(protected ApiClient $apiClient) { }

    /**
     * This function will build the query string the way twitch requires it
     *
     * @param array $query
     *
     * @return array|string|string[]|null
     */
    private function buildQueryString(array $query)
    {
        // Remove empty values and put everything together
        $queryString = http_build_query(array_filter($query), null);

        return preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $queryString);
    }

    /**
     * @param string                    $path
     * @param array                     $query
     * @param string|null               $type
     * @param string                    $method
     * @param array|null                $body
     * @param AccessTokenInterface|null $accessToken
     * @param array                     $headers
     *
     * @return TwitchResponseInterface|null
     * @throws \JsonException
     */
    protected function sendRequest(
        string $path,
        array $query = [],
        string $type = null,
        string $method = Request::METHOD_GET,
        array $body = null,
        AccessTokenInterface $accessToken = null,
        array $headers = []
    ): ?TwitchResponseInterface {
        $uri = new Uri(ApiClientInterface::BASE_API_URL . $path);

        return $this->apiClient->sendRequest(
            $uri->withQuery($this->buildQueryString($query)), $type, $method, $body, $accessToken, $headers
        );
    }
}

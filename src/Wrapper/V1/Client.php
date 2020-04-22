<?php

namespace Legito\Api\Wrapper\V1;

/**
 * Class Client
 * @package Legito\Api\Wrapper\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Client
{
    protected const API_URL = 'https://www.legito.com/api/v1';

    protected const AUTH_HEADER = 'Authorization';
    protected const AUTH_HEADER_TYPE = 'Bearer ';

    public const HTTP_SUCCESS = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_ERROR = 500;

    /** @var \RestClient */
    protected $restClient;

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $privateKey;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $privateKey
     * @param string|null $url
     */
    public function __construct(string $apiKey, string $privateKey, ?string $url = NULL)
    {
        $this->restClient = new \RestClient([
            'headers' => [
                'Content-Type' => 'application/json',
                self::AUTH_HEADER => ''
            ],
            'base_url' => $url ?? self::API_URL,
            'user_agent' => 'legito-wrapper/2.0.0',
            'curl_options' => [CURLOPT_SSL_VERIFYPEER => 0]
        ]);

        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
    }

    /**
     * Creates GET request
     * @param string $baseUrl
     * @param array $parameters
     * @param array $queryParameters
     * @return \RestClient
     */
    public function get(string $baseUrl, array $parameters = [], array $queryParameters = [])
    {
        $this->createAuthHeader();

        $url = $this->createUrlFromParameters($baseUrl, $parameters);

        return $this->restClient->get($url, $queryParameters);
    }

    /**
     * Creates POST request
     * @param string $baseUrl
     * @param array $parameters
     * @param null $data
     * @return \RestClient
     */
    public function post(string $baseUrl, array $parameters = [], $data = NULL)
    {
        $this->createAuthHeader();

        $url = $this->createUrlFromParameters($baseUrl, $parameters);

        return $this->restClient->post($url, json_encode($data, JSON_PRETTY_PRINT | JSON_PRESERVE_ZERO_FRACTION));
    }

    /**
     * Creates PUT request
     * @param $url
     * @param array $parameters
     * @param null $data
     * @return \RestClient
     */
    public function put(string $baseUrl, array $parameters = [], $data = NULL)
    {
        $this->createAuthHeader();

        $url = $this->createUrlFromParameters($baseUrl, $parameters);

        return $this->restClient->put($url, json_encode($data, JSON_PRETTY_PRINT | JSON_PRESERVE_ZERO_FRACTION));
    }

    /**
     * Creates DELETE request
     * @param $url
     * @param array $parameters
     * @param null $data
     * @return \RestClient
     */
    public function delete(string $baseUrl, array $parameters = [])
    {
        $this->createAuthHeader();

        $url = $this->createUrlFromParameters($baseUrl, $parameters);

        return $this->restClient->delete($url);
    }

    /**
     * Creates request URL from parameters
     * @return string
     */
    protected function createUrlFromParameters(string $baseUrl, array $parameters = []): string
    {
        $parametersUrl = '';
        if (!empty($parameters)) {
            $parametersUrl = '/' . implode('/', array_filter($parameters));
        }

        return rtrim($baseUrl, '/') . $parametersUrl;
    }

    /**
     * Creates authentication header
     * @return void
     */
    protected function createAuthHeader(): void
    {
        $token = Authenticator::createAuthToken($this->apiKey, $this->privateKey);

        $this->restClient->options['headers'][self::AUTH_HEADER] = self::AUTH_HEADER_TYPE . $token;
    }
}

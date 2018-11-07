<?php

namespace Legito\Api\Wrapper;

/**
 * Class Client
 * @package Legito\Api\Wrapper
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Client
{

    protected const API_URL = 'https://www.legito.com/api/v1.0';

    protected const AUTH_HEADER = 'X-HTTP-AUTH-TOKEN';

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

    /** @var int */
    protected $timestamp;

    public function __construct(string $apiKey, string $privateKey, ?string $url = NULL)
    {
        $this->restClient = new \RestClient([
            'headers' => [
                'Content-Type' => 'application/json',
                self::AUTH_HEADER => ''
            ],
            'base_url' => $url ?? self::API_URL,
            'user_agent' => 'legito-pwc-integration/1.0',
            'curl_options' => [CURLOPT_SSL_VERIFYPEER => 0]
        ]);

        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
    }

    /**
     * Creates GET request
     * @param $url
     * @param array $parameters
     * @return \RestClient
     */
    public function get($url, array $parameters = [])
    {
        $this->createTimestamp();
        $this->createAuthHeader($parameters);

        $parametersUrl = '';
        if (!empty($parameters)) {
            $parametersUrl = implode('/', array_filter($parameters)) . '/';
        }

        return $this->restClient->get($url . $parametersUrl . $this->timestamp . '/');
    }

    /**
     * Creates POST request
     * @param $url
     * @param array $parameters
     * @param null $data
     * @return \RestClient
     */
    public function post($url, array $parameters = [], $data = NULL)
    {
        $this->createTimestamp();
        $this->createAuthHeader($parameters, $data);

        $parametersUrl = '';
        if (!empty($parameters)) {
            $parametersUrl = implode('/', array_filter($parameters)) . '/';
        }

        return $this->restClient->post($url . $parametersUrl . $this->timestamp . '/', json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Creates PUT request
     * @param $url
     * @param array $parameters
     * @param null $data
     * @return \RestClient
     */
    public function put($url, array $parameters = [], $data = NULL)
    {
        $this->createTimestamp();
        $this->createAuthHeader($parameters, $data);

        $parametersUrl = '';
        if (!empty($parameters)) {
            $parametersUrl = implode('/', array_filter($parameters)) . '/';
        }

        return $this->restClient->put($url . $parametersUrl . $this->timestamp . '/', json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Creates DELETE request
     * @param $url
     * @param array $parameters
     * @param null $data
     * @return \RestClient
     */
    public function delete($url, array $parameters = [])
    {
        $this->createTimestamp();
        $this->createAuthHeader($parameters);

        $parametersUrl = '';
        if (!empty($parameters)) {
            $parametersUrl = implode('/', array_filter($parameters)) . '/';
        }

        return $this->restClient->delete($url . $parametersUrl . $this->timestamp . '/');
    }

    /**
     * Creates and sets timestamp
     * @return void
     */
    protected function createTimestamp(): void
    {
        $this->timestamp = time();
    }

    /**
     * Creates authentication header
     * @param array $parameters
     * @param array $requestBody
     * @return void
     */
    protected function createAuthHeader(array $parameters, array $requestBody = []): void
    {
        $parameters['timestamp'] = $this->timestamp;

        $requestData = array_merge(array_filter($parameters), $requestBody);

        $sign = Authenticator::signRequest($requestData, $this->privateKey);
        $token = Authenticator::createAuthToken($this->apiKey, $sign);

        $this->restClient->options['headers'][self::AUTH_HEADER] = $token;
    }

}
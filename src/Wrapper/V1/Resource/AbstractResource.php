<?php

namespace Legito\Api\Wrapper\Resource\V1;

use Legito\Api\Wrapper\Exception\ApiResponseException;
use Legito\Api\Wrapper\Exception\NotFoundException;
use Legito\Api\Wrapper\V1\Client;

/**
 * Class AbstractResource
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
abstract class AbstractResource
{

    /** @var Client */
    protected $client;

    /**
     * AbstractResource constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Processes response
     * @param \RestClient $response
     * @return mixed
     * @throws NotFoundException
     */
    protected function processResponse(\RestClient $result)
    {
        $responseCode = $result->info->http_code;

        switch ($responseCode) {
            case Client::HTTP_SUCCESS:
            case Client::HTTP_CREATED:
                return $result->decode_response();

                break;
            case Client::HTTP_NOT_FOUND:
                $response = $result->decode_response();

                throw new NotFoundException($response->message, $response->code);

                break;

            default:
                try {
                    $response = $result->decode_response();
                } catch (\RestClientException $e) {
                    throw new ApiResponseException('Legito API responsed with unhandled error');
                }

                if (is_object($response)) {
                    throw new ApiResponseException($response->message, $response->code);
                }

                throw new ApiResponseException('Legito API responsed with:"' . implode(',', $result->response_status_lines)  . '"');
        }
    }

}
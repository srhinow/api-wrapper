<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class Law
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Law extends AbstractResource
{
    protected const RESOURCE = '/law/';

    /**
     * Returns group list
     * @return array
     * @throws \RestClientException
     */
    public function getLaw(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}
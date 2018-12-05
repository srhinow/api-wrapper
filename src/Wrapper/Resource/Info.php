<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class Info
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Info extends AbstractResource
{
    protected const RESOURCE = '/info/';

    /**
     * Returns version
     * @return \stdClass
     * @throws \RestClientException
     */
    public function getInfo(): \stdClass
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}
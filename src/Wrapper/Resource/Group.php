<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class Group
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Group extends AbstractResource
{
    protected const RESOURCE = '/group/';

    /**
     * Returns group list
     * @return array
     * @throws \RestClientException
     */
    public function getGroup(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}
<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class Currency
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Currency extends AbstractResource
{
    protected const RESOURCE = '/currency';

    /**
     * Returns currency list
     * @return array
     * @throws \RestClientException
     */
    public function getCurrency(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}

<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class Law
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Country extends AbstractResource
{
    protected const RESOURCE = '/country';

    /**
     * Returns country list
     * @return array
     * @throws \RestClientException
     */
    public function getCountry(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}

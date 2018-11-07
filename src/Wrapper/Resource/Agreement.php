<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class Agreement
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Agreement extends AbstractResource
{
    protected const RESOURCE = '/agreement/';

    /**
     * Returns agreement list
     * @return array
     * @throws \RestClientException
     */
    public function getAgreement(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}
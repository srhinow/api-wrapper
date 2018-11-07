<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class AgreementTemplate
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class AgreementTemplate extends AbstractResource
{
    protected const RESOURCE = '/agreement-template/';

    /**
     * Returns agreement list
     * @return array
     * @throws \RestClientException
     */
    public function getAgreementTemplate(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}
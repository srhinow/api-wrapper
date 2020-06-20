<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class AgreementTemplate
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class AdvancedStyle extends AbstractResource
{
    protected const RESOURCE = '/advanced-style';

    /**
     * Returns advanced style list
     * @return array
     * @throws \RestClientException
     */
    public function getAdvancedStyle(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}

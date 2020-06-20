<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class Agreement
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class TemplateSuite extends AbstractResource
{
    protected const RESOURCE = '/template-suite';

    /**
     * Returns template suite list
     * @return array
     * @throws \RestClientException
     */
    public function getTemplateSuite(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}

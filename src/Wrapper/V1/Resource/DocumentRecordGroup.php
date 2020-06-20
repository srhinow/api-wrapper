<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class DocumentRecordGroup
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class DocumentRecordGroup extends AbstractResource
{
    protected const RESOURCE = '/document-record-group';

    /**
     * Returns document record group list
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentRecordGroup(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }
}
<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class DocumentRecord
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class DocumentRecord extends AbstractResource
{
    protected const RESOURCE = '/document-record';

    /**
     * Returns document record list
     * @param int|null $limit Min limit is 0; Max limit is 1000
     * @param int|null $offset
     * @param int|null $templateSuiteId
     * @param bool|null $deleted
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentRecord(?int $limit = NULL, ?int $offset = NULL, ?int $templateSuiteId = NULL, ?bool $deleted = NULL): array
    {
        $result = $this->client->get(
            self::RESOURCE,
            [],
            [
                'limit' => $limit,
                'offset' => $offset,
                'templateSuiteId' => $templateSuiteId,
                'deleted' => (int) $deleted
            ]
        );

        return $this->processResponse($result);
    }

    /**
     * Puts document record
     * @param string $code
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putDocumentRecord(string $code, $data = NULL): \stdClass
    {
        $result = $this->client->put(
            self::RESOURCE,
            [
                'code' => $code
            ],
            $data
        );

        return $this->processResponse($result);
    }

    /**
     * Deletes document record
     * @param string $code
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteDocumentRecord(string $code): \stdClass
    {
        $result = $this->client->delete(
            self::RESOURCE,
            [
                'code' => $code,
            ]
        );

        return $this->processResponse($result);
    }
}

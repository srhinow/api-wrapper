<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class Document
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Document extends AbstractResource
{
    protected const RESOURCE = '/document/';

    protected const RELATION_DATA = 'data/';
    protected const RELATION_INSTANCE = 'instance/';
    protected const RELATION_DOWNLOAD = 'download/';

    /**
     * Returns document list
     * @return array
     * @throws \RestClientException
     */
    public function getDocument(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }

    /**
     * Returns document elements data
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentData(string $code): array
    {
        $result = $this->client->get(
            self::RESOURCE . self:: RELATION_DATA,
            [
                'code' => $code
            ]
        );

        return $this->processResponse($result);
    }

    /**
     * Puts document elements data into document
     * @param mixed $data
     * @return array
     * @throws \RestClientException
     */
    public function putDocumentData($data = NULL): array
    {
        $result = $this->client->put(
            self::RESOURCE . self:: RELATION_DATA,
            [],
            $data
        );

        return $this->processResponse($result);
    }

    /**
     * Returns document elements data in tree
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentDataTree(string $code): array
    {
        $result = $this->client->get(
            self::RESOURCE . self:: RELATION_DATA,
            [
                'code' => $code,
                'tree' => 'tree'
            ]
        );

        return $this->processResponse($result);
    }

    /**
     * Returns document instance list
     * @param int $agreementId
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentInstance(int $agreementId): array
    {
        $result = $this->client->get(
            self::RESOURCE . self::RELATION_INSTANCE,
            [
                'agreementId' => $agreementId
            ]
        );

        return $this->processResponse($result);
    }

    /**
     * Creates document instance and post elements data into document
     * @param int $agreementId
     * @param mixed $data
     * @return array
     * @throws \RestClientException
     */
    public function postDocumentInstance(int $agreementId, $data = NULL): array
    {
        $result = $this->client->post(
            self::RESOURCE . self:: RELATION_INSTANCE,
            [
                'agreementId' => $agreementId
            ],
            $data
        );

        return $this->processResponse($result);
    }

    /**
     * Downloads document in base64 encoded file
     * @param string $code
     * @param string $format
     * @param string $documentId
     * @param int $templateId
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentDownload(string $code, string $format, ?int $documentId = NULL, ?int $templateId = NULL): array
    {
        $result = $this->client->get(
            self::RESOURCE . self::RELATION_DOWNLOAD,
            [
                'code' => $code,
                'format' => $format,
                'documentId' => $documentId,
                'templateId' => $templateId
            ]
        );

        return $this->processResponse($result);
    }
}
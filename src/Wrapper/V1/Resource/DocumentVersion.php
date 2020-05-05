<?php

namespace Legito\Api\Wrapper\Resource\V1;


/**
 * Class Document
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class DocumentVersion extends AbstractResource
{
    protected const RESOURCE = '/document-version';

    protected const RELATION_DATA = '/data';
    protected const RELATION_DOWNLOAD = '/download';

    /**
     * Returns document version elements data
     * @param string $code
     * @param string|null $listType
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentVersionData(string $code, ?string $listType): array
    {
        $result = $this->client->get(
            self::RESOURCE . self:: RELATION_DATA,
            [
                'code' => $code
            ],
            [
                'listType' => $listType
            ]
        );

        return $this->processResponse($result);
    }

    /**
     * Inserts elements data into template and creates new document version
     * @param int $agreementId
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postDocumentVersionData(int $templateSuiteId, $data = NULL): \stdClass
    {
        $result = $this->client->post(
            self::RESOURCE . self:: RELATION_DATA,
            [
                'templateSuiteId' => $templateSuiteId
            ],
            $data
        );

        return $this->processResponse($result);
    }

    /**
     * Puts elements data into template and creates new document version
     * @param string $code
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putDocumentVersionData(string $code, $data = NULL): \stdClass
    {
        $result = $this->client->put(
            self::RESOURCE . self:: RELATION_DATA,
            [
                'code' => $code
            ],
            $data
        );

        return $this->processResponse($result);
    }

    /**
     * Downloads document version in base64 encoded file
     * @param string $code
     * @param string $format
     * @param string $documentId
     * @param int $templateId
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentVersionDownload(string $code, string $format, ?int $templateId = NULL, ?int $advancedStyleId = NULL): array
    {
        $result = $this->client->get(
            self::RESOURCE . self::RELATION_DOWNLOAD,
            [
                'code' => $code,
                'format' => $format,
                'templateId' => $templateId,
                'advancedStyleId' => $advancedStyleId
            ]
        );

        return $this->processResponse($result);
    }
}
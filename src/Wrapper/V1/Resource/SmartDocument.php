<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class Document
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class SmartDocument extends AbstractResource
{
    protected const RESOURCE = '/smart-document';

    protected const RELATION_DATA = '/data';
    protected const RELATION_DOWNLOAD = '/download';

    /**
     * Returns smart document elements data
     * @param string $code
     * @param string|null $listType
     * @return array
     * @throws \RestClientException
     */
    public function getSmartDocumentData(string $code, ?string $listType): array
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
     * Creates smart document version and post elements data into smart document
     * @param int $agreementId
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postSmartDocumentData(int $templateSuiteId, $data = NULL): \stdClass
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
     * Puts document elements data into smart document
     * @param string $code
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putSmartDocumentData(string $code, $data = NULL): \stdClass
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
     * Downloads smart document in base64 encoded file
     * @param string $code
     * @param string $format
     * @param string $documentId
     * @param int $templateId
     * @return array
     * @throws \RestClientException
     */
    public function getSmartDocumentDownload(string $code, string $format, ?int $templateId = NULL, ?int $advancedStyleId = NULL): array
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
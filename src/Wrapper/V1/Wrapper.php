<?php

namespace Legito\Api\Wrapper\V1;

use Legito\Api\Wrapper\V1\Resource\Country;
use Legito\Api\Wrapper\V1\Resource\Currency;
use Legito\Api\Wrapper\V1\Resource\DocumentRecord;
use Legito\Api\Wrapper\V1\Resource\DocumentRecordGroup;
use Legito\Api\Wrapper\V1\Resource\Info;
use Legito\Api\Wrapper\V1\Resource\AdvancedStyle;
use Legito\Api\Wrapper\V1\Resource\Share;
use Legito\Api\Wrapper\V1\Resource\SmartDocument;
use Legito\Api\Wrapper\V1\Resource\TemplateSuite;
use Legito\Api\Wrapper\V1\Resource\Timezone;
use Legito\Api\Wrapper\V1\Resource\User;
use Legito\Api\Wrapper\V1\Resource\UserGroup;

/**
 * Class Legito
 * @package Legito\Api\Wrapper
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Wrapper
{

    /** @var AdvancedStyle */
    protected $advancesStyleResource;

    /** @var Country */
    protected $countryResource;

    /** @var Currency */
    protected $currencyResource;

    /** @var DocumentRecord */
    protected $documentRecordResource;

    /** @var DocumentRecord */
    protected $documentRecordGroupResource;

    /** @var Info */
    protected $infoResource;

    /** @var Share */
    protected $shareResource;

    /** @var TemplateSuite */
    protected $smartDocumentResource;

    /** @var TemplateSuite */
    protected $templateSuiteResource;

    /** @var Timezone */
    protected $timezoneResource;

    /** @var User */
    protected $userResource;

    /** @var UserGroup */
    protected $userGroupResource;

    public function __construct(string $apiKey, string $privateKey, ?string $url = NULL)
    {
        $client = new Client($apiKey, $privateKey, $url);

        $this->advancesStyleResource = new AdvancedStyle($client);
        $this->countryResource = new Country($client);
        $this->currencyResource = new Currency($client);
        $this->documentRecordResource = new DocumentRecord($client);
        $this->documentRecordGroupResource = new DocumentRecordGroup($client);
        $this->shareResource = new Share($client);
        $this->smartDocumentResource = new SmartDocument($client);
        $this->timezoneResource = new Timezone($client);
        $this->templateSuiteResource = new TemplateSuite($client);
        $this->userResource = new User($client);
        $this->userGroupResource = new UserGroup($client);
    }

    /**
     * Returns advanced style list
     * @return array
     * @throws \RestClientException
     */
    public function getAdvancedStyle(): array
    {
        return $this->advancesStyleResource->getAdvancedStyle();
    }

    /**
     * Returns country list
     * @return array
     * @throws \RestClientException
     */
    public function getCountry(): array
    {
        return $this->countryResource->getCountry();
    }

    /**
     * Returns currency list
     * @return array
     * @throws \RestClientException
     */
    public function getCurrency(): array
    {
        return $this->currencyResource->getCurrency();
    }

    /**
     * Returns document record list
     * @param int|null $limit Min limit is 0; Max limit is 1000
     * @param int|null $offset
     * @param int|null $templateSuiteId
     * @param bool|null $deleted
//     * @return array
     * @throws \RestClientException
     */
    public function getDocumentRecord(?int $limit = NULL, ?int $offset = NULL, ?int $templateSuiteId = NULL, ?bool $deleted = NULL)
    {
        return $this->documentRecordResource->getDocumentRecord($limit, $offset, $templateSuiteId, $deleted);
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
        return $this->documentRecordResource->putDocumentRecord($code, $data);
    }

    /**
     * Deletes document record
     * @param string $code
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteDocumentRecord(string $code): \stdClass
    {
        return $this->documentRecordResource->deleteDocumentRecord($code);
    }

    /**
     * Returns group list
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentRecordGroup(): array
    {
        return $this->documentRecordGroupResource->getDocumentRecordGroup();
    }

    /**
     * Returns info
     * @return \stdClass
     * @throws \RestClientException
     */
    public function getInfo(): \stdClass
    {
        return $this->infoResource->getInfo();
    }

    /**
     * Returns share list for document record
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getShare(string $code): array
    {
        return $this->shareResource->getShare($code);
    }

    /**
     * Posts user share
     * @param string $code
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postShareUser(string $code, $data = NULL): \stdClass
    {
        return $this->shareResource->postShareUser($code, $data);
    }

    /**
     * Deletes user share
     * @param string $code
     * @param string $idEmail
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteShareUser(string $code, string $idEmail): \stdClass
    {
        return $this->shareResource->deleteShareUser($code, $idEmail);
    }
    
    /**
     * Posts user group share
     * @param string $code
     * @param array|NULL $data
     * @return array
     * @throws \RestClientException
     */
    public function postShareUserGroup(string $code, $data = NULL): array
    {
        return $this->shareResource->postShareUserGroup($code, $data);
    }

    /**
     * Deletes user group share
     * @param string $code
     * @param string $idEmail
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteShareUserGroup(string $code, string $idEmail): \stdClass
    {
        return $this->shareResource->deleteShareUserGroup($code, $idEmail);
    }

    /**
     * Returns smart document elements data
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getSmartDocumentData(string $code): array
    {
        return $this->smartDocumentResource->getSmartDocumentData($code);
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
        return $this->smartDocumentResource->postSmartDocumentData($templateSuiteId, $data);
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
        return $this->smartDocumentResource->putSmartDocumentData($code, $data);
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
        return $this->smartDocumentResource->getSmartDocumentDownload($code, $format, $templateId, $advancedStyleId);
    }

    /**
     * Returns template suite list
     * @return array
     * @throws \RestClientException
     */
    public function getTemplateSuite(): array
    {
        return $this->templateSuiteResource->getTemplateSuite();
    }

    /**
     * Returns timezone list
     * @return array
     * @throws \RestClientException
     */
    public function getTimezone(): array
    {
        return $this->timezoneResource->getTimezone();
    }


    /**
     * Returns user list
     * @return array
     * @throws \RestClientException
     */
    public function getUser(): array
    {
        return $this->userResource->getUser();
    }

    /**
     * Posts user
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postUser($data = NULL): \stdClass
    {
        return $this->userResource->postUser($data);
    }

    /**
     * Puts user
     * @param string $idEmail
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putUser(string $idEmail, $data = NULL): \stdClass
    {
        return $this->userResource->putUser($idEmail, $data);
    }

    /**
     * Deletes user
     * @param string $idEmail
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteUser(string $idEmail): \stdClass
    {
        return $this->userResource->deleteUser($idEmail);
    }

    /**
     * Posts user permission
     * @param string $idEmail
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putUserPermission(string $idEmail, $data = NULL): \stdClass
    {
        return $this->userResource->putUserPermission($idEmail, $data);
    }

    /**
     * Returns user group list
     * @return array
     * @throws \RestClientException
     */
    public function getUserGroup(): array
    {
        return $this->userGroupResource->getUserGroup();
    }

    /**
     * Posts user group
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postUserGroup($data = NULL): \stdClass
    {
        return $this->userGroupResource->postUserGroup($data);
    }

    /**
     * Updates user group
     * @param int $userGroupId
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putUserGroup(int $userGroupId, $data = NULL): \stdClass
    {
        return $this->userGroupResource->putUserGroup($userGroupId, $data);
    }

    /**
     * Deletes user group
     * @param int $userGroupId
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteUserGroup(int $userGroupId): \stdClass
    {
        return $this->userGroupResource->deleteUserGroup($userGroupId);
    }

    /**
     * Inserts user to user group
     * @param int $userGroupId
     * @param array|NULL $data
     * @return mixed
     * @throws \RestClientException
     */
    public function postUserGroupUser(string $userGroupId, $data = NULL)
    {
        return $this->userGroupResource->postUserGroupUser($userGroupId, $data);
    }

    /**
     * Inserts user to user group
     * @param int $userGroupId
     * @param string $idEmail
     * @return mixed
     * @throws \RestClientException
     */
    public function deleteUserGroupUser(string $userGroupId, string $idEmail)
    {
        return $this->userGroupResource->deleteUserGroupUser($userGroupId, $idEmail);
    }
}

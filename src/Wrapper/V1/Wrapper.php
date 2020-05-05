<?php

namespace Legito\Api\Wrapper\V1;

use Legito\Api\Wrapper\Resource\V1\AdvancedStyle;
use Legito\Api\Wrapper\Resource\V1\Country;
use Legito\Api\Wrapper\Resource\V1\Currency;
use Legito\Api\Wrapper\Resource\V1\DocumentRecord;
use Legito\Api\Wrapper\Resource\V1\Category;
use Legito\Api\Wrapper\Resource\V1\Info;
use Legito\Api\Wrapper\Resource\V1\Share;
use Legito\Api\Wrapper\Resource\V1\DocumentVersion;
use Legito\Api\Wrapper\Resource\V1\TemplateSuite;
use Legito\Api\Wrapper\Resource\V1\Timezone;
use Legito\Api\Wrapper\Resource\V1\User;
use Legito\Api\Wrapper\Resource\V1\UserGroup;

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
    protected $categoryResource;

    /** @var Info */
    protected $infoResource;

    /** @var Share */
    protected $shareResource;

    /** @var TemplateSuite */
    protected $documentVersionResource;

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
        $this->categoryResource = new Category($client);
        $this->countryResource = new Country($client);
        $this->currencyResource = new Currency($client);
        $this->documentRecordResource = new DocumentRecord($client);
        $this->documentVersionResource = new DocumentVersion($client);
        $this->shareResource = new Share($client);
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
     * Returns category list
     * @return array
     * @throws \RestClientException
     */
    public function getCategory(): array
    {
        return $this->categoryResource->getCategory();
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
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentRecord(?int $limit = NULL, ?int $offset = NULL, ?int $templateSuiteId = NULL, ?bool $deleted = NULL): array
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
     * Returns document version elements data
     * @param string $code
     * @param string|null $listType
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentVersionData(string $code, ?string $listType): array
    {
        return $this->documentVersionResource->getDocumentVersionData($code, $listType);
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
        return $this->documentVersionResource->postDocumentVersionData($templateSuiteId, $data);
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
        return $this->documentVersionResource->putDocumentVersionData($code, $data);
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
        return $this->documentVersionResource->getDocumentVersionDownload($code, $format, $templateId, $advancedStyleId);
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

<?php

namespace Legito\Api;

use Legito\Api\Wrapper\Client;
use Legito\Api\Wrapper\Resource\Agreement;
use Legito\Api\Wrapper\Resource\AgreementTemplate;
use Legito\Api\Wrapper\Resource\Currency;
use Legito\Api\Wrapper\Resource\Department;
use Legito\Api\Wrapper\Resource\Document;
use Legito\Api\Wrapper\Resource\Group;
use Legito\Api\Wrapper\Resource\Info;
use Legito\Api\Wrapper\Resource\Law;
use Legito\Api\Wrapper\Resource\Share;
use Legito\Api\Wrapper\Resource\Timezone;
use Legito\Api\Wrapper\Resource\User;

/**
 * Class Legito
 * @package Legito\Api\Wrapper
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Legito
{

    protected const RESOURCES = [
        Agreement::class,
        AgreementTemplate::class,
        Currency::class,
        Department::class,
        Document::class,
        Group::class,
        Info::class,
        Law::class,
        Share::class,
        Timezone::class,
        User::class
    ];

    /** @var array<Agreement|AgreementTemplate|Currency|Department|Document|Group|Law|Timezone|User> */
    protected $resources;

    public function __construct(string $apiKey, string $privateKey, ?string $url = NULL)
    {
        $client = new Client($apiKey, $privateKey, $url);

        foreach (self::RESOURCES as $resource) {
            $this->resources[$resource] = new $resource($client);
        }
    }

    /**
     * Returns agreement list
     * @return array
     * @throws \RestClientException
     */
    public function getAgreement(): array
    {
        return $this->resources[Agreement::class]->getAgreement();
    }

    /**
     * Returns agreement template list
     * @return array
     * @throws \RestClientException
     */
    public function getAgreementTemplate(): array
    {
        return $this->resources[AgreementTemplate::class]->getAgreementTemplate();
    }

    /**
     * Returns currency list
     * @return array
     * @throws \RestClientException
     */
    public function getCurrency(): array
    {
        return $this->resources[Currency::class]->getAgreementTemplate();
    }

    /**
     * Returns department list
     * @return array
     * @throws \RestClientException
     */
    public function getDepartment(): array
    {
        return $this->resources[Department::class]->getDepartment();
    }

    /**
     * Posts department
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postDeparment($data = NULL): \stdClass
    {
        return $this->resources[Department::class]->postDeparment($data);
    }

    /**
     * Updates department
     * @param int $departmentId
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putDeparment(int $departmentId, $data = NULL): \stdClass
    {
        return $this->resources[Department::class]->putDeparment($departmentId, $data);
    }

    /**
     * Inserts user to department
     * @param int $departmentId
     * @param array|NULL $data
     * @return mixed
     * @throws \RestClientException
     */
    public function postDepartmentUser(string $departmentId, $data = NULL)
    {
        return $this->resources[Department::class]->postDepartmentUser($departmentId, $data);
    }

    /**
     * Inserts user to department
     * @param int $departmentId
     * @param string $idEmail
     * @return mixed
     * @throws \RestClientException
     */
    public function deleteDepartmentUser(string $departmentId, string $idEmail)
    {
        return $this->resources[Department::class]->deleteDepartmentUser($departmentId, $idEmail);
    }


    /**
     * Returns document list
     * @param int|null $limit Min limit is 0; Max limit is 1000
     * @param int|null $offset
     * @param int|null $agreementId
     * @param bool|null $deleted
     * @return array
     * @throws \RestClientException
     */
    public function getDocument(?int $limit = NULL, ?int $offset = NULL, ?int $agreementId = NULL, ?bool $deleted = NULL): array
    {
        return $this->resources[Document::class]->getDocument($limit, $offset, $agreementId, $deleted);
    }

    /**
     * Puts document metadata
     * @param string $code
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putDocument(string $code, $data = NULL): \stdClass
    {
        return $this->resources[Document::class]->putDocument($code, $data);
    }

    /**
     * Deletes document
     * @param string $code
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteDocument(string $code): \stdClass
    {
        return $this->resources[Document::class]->deleteDocument($code);
    }

    /**
     * Returns document elements data
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentData(string $code): array
    {
        return $this->resources[Document::class]->getDocumentData($code);
    }

    /**
     * Creates document instance and post elements data into document
     * @param int $agreementId
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postDocumentData(int $agreementId, $data = NULL): \stdClass
    {
        return $this->resources[Document::class]->postDocumentData($agreementId, $data);
    }

    /**
     * Puts docuemnt elements data into document
     * @param string $code
     * @param mixed $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function putDocumentData(string $code, $data = NULL): \stdClass
    {
        return $this->resources[Document::class]->putDocumentData($code, $data);
    }

    /**
     * Returns document elements data in tree
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentDataTree(string $code): array
    {
        return $this->resources[Document::class]->getDocumentDataTree($code);
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
        return $this->resources[Document::class]->getDocumentDownload($code, $format, $documentId, $templateId);
    }

    /**
     * Returns group list
     * @return array
     * @throws \RestClientException
     */
    public function getGroup(): array
    {
        return $this->resources[Group::class]->getGroup();
    }

    /**
     * Returns info
     * @return \stdClass
     * @throws \RestClientException
     */
    public function getInfo(): \stdClass
    {
        return $this->resources[Info::class]->getInfo();
    }

    /**
     * Returns group list
     * @return array
     * @throws \RestClientException
     */
    public function getLaw(): array
    {
        return $this->resources[Law::class]->getLaw();
    }


    /**
     * Returns share list for document
     * @param string $code
     * @return array
     * @throws \RestClientException
     */
    public function getShare(string $code): array
    {
        return $this->resources[Share::class]->getShare($code);
    }

    /**
     * Posts user share
     * @param string $code
     * @param array|NULL $data
     * @return array
     * @throws \RestClientException
     */
    public function postShareUser(string $code, $data = NULL): array
    {
        return $this->resources[Share::class]->postShareUser($code, $data);
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
        return $this->resources[Share::class]->deleteShareUser($code, $idEmail);
    }
    
    /**
     * Posts department share
     * @param string $code
     * @param array|NULL $data
     * @return array
     * @throws \RestClientException
     */
    public function postShareDepartment(string $code, $data = NULL): array
    {
        return $this->resources[Share::class]->postShareDepartment($code, $data);
    }

    /**
     * Deletes department share
     * @param string $code
     * @param string $idEmail
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteShareDepartment(string $code, string $idEmail): \stdClass
    {
        return $this->resources[Share::class]->deleteShareDepartment($code, $idEmail);
    }


    /**
     * Returns timezone list
     * @return array
     * @throws \RestClientException
     */
    public function getTimezone(): array
    {
        return $this->resources[Timezone::class]->getTimezone();
    }


    /**
     * Returns user list
     * @return array
     * @throws \RestClientException
     */
    public function getUser(): array
    {
        return $this->resources[User::class]->getUser();
    }

    /**
     * Posts user
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postUser($data = NULL): \stdClass
    {
        return $this->resources[User::class]->postUser($data);
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
        return $this->resources[User::class]->putUser($idEmail, $data);
    }

    /**
     * Deletes user
     * @param string $idEmail
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteUser(string $idEmail): \stdClass
    {
        return $this->resources[User::class]->deleteUser($idEmail);
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
        return $this->resources[User::class]->putUserPermission($idEmail, $data);
    }
}

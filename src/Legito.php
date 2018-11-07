<?php

namespace Legito\Api;

use Legito\Api\Wrapper\Client;
use Legito\Api\Wrapper\Resource\Agreement;
use Legito\Api\Wrapper\Resource\AgreementTemplate;
use Legito\Api\Wrapper\Resource\Currency;
use Legito\Api\Wrapper\Resource\Department;
use Legito\Api\Wrapper\Resource\Document;
use Legito\Api\Wrapper\Resource\Group;
use Legito\Api\Wrapper\Resource\Law;
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
        Law::class,
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
     * @return array
     * @throws \RestClientException
     */
    public function getDocument(): array
    {
        return $this->resources[Document::class]->getDocument();
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
     * Puts docuemnt elements data into document
     * @param mixed $data
     * @return array
     * @throws \RestClientException
     */
    public function putDocumentData($data = NULL): array
    {
        return $this->resources[Document::class]->putDocumentData($data);
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
     * Returns document instance list
     * @param int $agreementId
     * @return array
     * @throws \RestClientException
     */
    public function getDocumentInstance(int $agreementId): array
    {
        return $this->resources[Document::class]->getDocumentInstance($agreementId);
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
        return $this->resources[Document::class]->postDocumentInstance($agreementId, $data);
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
     * Returns group list
     * @return array
     * @throws \RestClientException
     */
    public function getLaw(): array
    {
        return $this->resources[Law::class]->getLaw();
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

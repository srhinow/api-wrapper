<?php

namespace Legito\Api\Wrapper\Resource;


/**
 * Class Department
 * @package Legito\Api\Wrapper\Resource
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Department extends AbstractResource
{
    protected const RESOURCE = '/department/';

    protected const RELATION_USER = 'user/';

    /**
     * Returns department list
     * @return array
     * @throws \RestClientException
     */
    public function getDepartment(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }

    /**
     * Posts department
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postDeparment($data = NULL): \stdClass
    {
        $result = $this->client->post(
            self::RESOURCE,
            [],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->put(
            self::RESOURCE,
            [
                'departmentId' => $departmentId
            ],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->post(
            self::RESOURCE . self::RELATION_USER,
            [
                'departmentId' => $departmentId
            ],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->delete(
            self::RESOURCE . self::RELATION_USER,
            [
                'departmentId' => $departmentId,
                'userId' => $idEmail
            ]
        );

        return $this->processResponse($result);
    }
}
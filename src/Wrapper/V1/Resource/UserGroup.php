<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class UserGroup
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class UserGroup extends AbstractResource
{
    protected const RESOURCE = '/user-group';

    protected const RELATION_USER = '/user';

    /**
     * Returns user group list
     * @return array
     * @throws \RestClientException
     */
    public function getUserGroup(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }

    /**
     * Posts user group
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postUserGroup($data = NULL): \stdClass
    {
        $result = $this->client->post(
            self::RESOURCE,
            [],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->put(
            self::RESOURCE,
            [
                'userGroupId' => $userGroupId
            ],
            $data
        );

        return $this->processResponse($result);
    }


    /**
     * Deletes user group
     * @param int $userGroupId
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteUserGroup(int $userGroupId): \stdClass
    {
        $result = $this->client->delete(
            self::RESOURCE,
            [
                'userGroupId' => $userGroupId
            ]
        );

        return $this->processResponse($result);
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
        $result = $this->client->post(
            self::RESOURCE . self::RELATION_USER,
            [
                'userGroupId' => $userGroupId
            ],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->delete(
            self::RESOURCE . self::RELATION_USER,
            [
                'userGroupId' => $userGroupId,
                'userId' => $idEmail
            ]
        );

        return $this->processResponse($result);
    }
}

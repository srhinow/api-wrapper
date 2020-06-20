<?php

namespace Legito\Api\Wrapper\V1\Resource;


/**
 * Class User
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class User extends AbstractResource
{
    protected const RESOURCE = '/user';

    protected const RELATION_PERMISSION = '/permission';

    /**
     * Returns user list
     * @return array
     * @throws \RestClientException
     */
    public function getUser(): array
    {
        $result = $this->client->get(self::RESOURCE);

        return $this->processResponse($result);
    }

    /**
     * Posts user
     * @param array|NULL $data
     * @return \stdClass
     * @throws \RestClientException
     */
    public function postUser($data = NULL): \stdClass
    {
        $result = $this->client->post(
            self::RESOURCE,
            [],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->put(
            self::RESOURCE,
            [
                'id' => $idEmail
            ],
            $data
        );

        return $this->processResponse($result);
    }

    /**
     * Deletes user
     * @param string $idEmail
     * @return \stdClass
     * @throws \RestClientException
     */
    public function deleteUser(string $idEmail): \stdClass
    {
        $result = $this->client->delete(
            self::RESOURCE,
            [
                'id' => $idEmail
            ]
        );

        return $this->processResponse($result);
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
        $result = $this->client->put(
            self::RESOURCE . self::RELATION_PERMISSION,
            [
                'id' => $idEmail
            ],
            $data
        );

        return $this->processResponse($result);
    }
}
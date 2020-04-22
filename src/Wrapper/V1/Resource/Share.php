<?php

namespace Legito\Api\Wrapper\Resource\V1;


/**
 * Class Share
 * @package Legito\Api\Wrapper\Resource\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Share extends AbstractResource
{
    protected const RESOURCE = '/share';

    protected const RELATION_USER = '/user';
    protected const RELATION_USER_GROUP = '/user-group';
    
    /**
     * Returns share list for document record
     * @return array
     * @throws \RestClientException
     */
    public function getShare(string $code): array
    {
        $result = $this->client->get(
            self::RESOURCE,
            [
                'code' => $code
            ]
        );

        return $this->processResponse($result);
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
        $result = $this->client->post(
            self::RESOURCE . self::RELATION_USER,
            [
                'code' => $code
            ],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->delete(
            self::RESOURCE . self::RELATION_USER,
            [
                'code' => $code,
                'id' => $idEmail
            ]
        );

        return $this->processResponse($result);
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
        $result = $this->client->post(
            self::RESOURCE . self::RELATION_USER_GROUP,
            [
                'code' => $code
            ],
            $data
        );

        return $this->processResponse($result);
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
        $result = $this->client->delete(
            self::RESOURCE . self::RELATION_USER_GROUP,
            [
                'code' => $code,
                'id' => $idEmail
            ]
        );

        return $this->processResponse($result);
    }
}
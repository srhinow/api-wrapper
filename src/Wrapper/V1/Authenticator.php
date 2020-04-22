<?php

namespace Legito\Api\Wrapper\V1;

use Firebase\JWT\JWT;

/**
 * Class Authenticator
 * @package Legito\Api\Wrapper\V1
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Authenticator
{
    private const EXPIRATION_TIME = 86400;

    private const JWT_ALGORITHM = 'HS256';

    /**
     * Creates authentification JWT token
     * @param string $apiKey
     * @param string $authHash
     * @return string
     */
    public static function createAuthToken(string $apiKey, string $privateKey): string
    {
        $currentTime = time();

        $payload = [
            'iss' => $apiKey,
            'iat' => $currentTime,
            'exp' => $currentTime + self::EXPIRATION_TIME,
        ];

        return JWT::encode($payload, $privateKey, self::JWT_ALGORITHM);
    }
}
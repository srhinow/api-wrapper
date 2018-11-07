<?php

namespace Legito\Api\Wrapper;

/**
 * Class Authenticator
 * @package Legito\Api\Wrapper
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Authenticator
{

    /**
     * Signs request with sha256 hash
     * @param array $requestData
     * @param string $privateKey
     * @return string
     */
    public static function signRequest(array $requestData, string $privateKey): string
    {
        return hash_hmac('sha256', self::stringify($requestData), $privateKey);
    }

    /**
     * Creates authentification token in {apiKey}:{hash} format
     * @param string $apiKey
     * @param string $authHash
     * @return string
     */
    public static function createAuthToken(string $apiKey, string $authHash): string
    {
        return base64_encode($apiKey . ':' . $authHash);
    }

    /**
     * Stringlifies input data for hash calculation
     * @param $data
     * @return string
     */
    protected static function stringify($data): string
    {
        $string = '';

        if (is_array($data)) {
            foreach ($data as $value) {
                $string .= '|' . self::stringify($value);
            }
        } elseif(is_bool($data)) {
            $string .= '|' . ($data ? 'TRUE' : 'FALSE');
        } else {
            $string .= '|' . (string) $data;
        }

        return ltrim($string, '|');
    }

}
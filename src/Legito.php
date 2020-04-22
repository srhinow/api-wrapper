<?php

namespace Legito\Api;

use Legito\Api\Wrapper\V1\Wrapper;

/**
 * Class Legito
 * @package Legito\Api\Wrapper
 * @author Marek Skopal, Legito s.r.o.
 * @license MIT
 */
class Legito
{
    /** @var Wrapper */
    private $wrapper;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $privateKey;

    /** @var string|null */
    private $url;

    /**
     * Legito constructor.
     * @param string $apiKey
     * @param string $privateKey
     * @param string|null $url
     */
    public function __construct(string $apiKey, string $privateKey, ?string $url = NULL)
    {
        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
        $this->url = $url;
    }

    /**
     * Returns last version wrapper
     * @return Wrapper
     */
    public function getWrapper(): Wrapper
    {
        return $this->getWraperV1();
    }

    /**
     * Returs wrapper version v1
     * @return Wrapper
     */
    public function getWraperV1(): Wrapper
    {
        if (!($this->wrapper instanceof Wrapper)) {
            $this->wrapper = new Wrapper($this->apiKey, $this->privateKey, $this->url);
        }

        return $this->wrapper;
    }
}

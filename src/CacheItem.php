<?php

namespace Dspacelabs\Component\Cache;

class CacheItem implements CacheItemInterface
{
    protected $key;
    protected $value;
    protected $expiresAt;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function get()
    {
        return $this->value;
    }

    public function set($value)
    {
        $this->value = $value;

        return $this;
    }

    public function isHit()
    {
    }

    public function exists()
    {
    }

    public function expiresAt($expiration)
    {
    }

    public function expiresAfter($time)
    {
    }

    public function getExpiration()
    {
        return $this->expiresAt;
    }
}

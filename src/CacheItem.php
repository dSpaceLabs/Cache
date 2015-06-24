<?php
/**
 */

namespace Dspacelabs\Component\Cache;

/**
 */
class CacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritDoc}
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritDoc}
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function set($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isHit()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function exists()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expiresAt($expiration)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expiresAfter($time)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getExpiration()
    {
        return $this->expiresAt;
    }
}

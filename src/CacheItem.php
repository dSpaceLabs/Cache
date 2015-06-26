<?php
/**
 */

namespace Dspacelabs\Component\Cache;

use Dspacelabs\Component\Cache\Adapter\AdapterInterface;

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
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param string $key
     */
    public function __construct($key, AdapterInterface $adapter)
    {
        $this->key     = $key;
        $this->adapter = $adapter;
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
        if (false === $this->isHit()) {
            return null;
        }

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
        if ($this->getExpiration()->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function exists()
    {
        return $this->adapter->exists($this);
    }

    /**
     * {@inheritDoc}
     */
    public function expiresAt($expiration)
    {
        $this->expiresAt = $expiration;
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
        if (null === $this->expiresAt) {
            return new \DateTime();
        }

        return $this->expiresAt;
    }
}

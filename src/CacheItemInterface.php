<?php
/**
 * @copyright 2015 dSpace Labs LLC
 * @license MIT
 */

namespace Dspacelabs\Component\Cache;

/**
 * Cache Item Interface
 */
interface CacheItemInterface
{
    /**
     * @return string
     */
    public function getKey();

    /**
     * @return mixed
     */
    public function get();

    /**
     * @param mixed $value
     */
    public function set($value);

    /**
     * @return boolean
     */
    public function isHit();

    /**
     * @return boolean
     */
    public function exists();

    /**
     * @param \DateTime $expiration
     */
    public function expiresAt($expiration);

    /**
     * @param integer|\DateTime $time
     */
    public function expiresAfter($time);

    /**
     * @return \DateTime
     */
    public function getExpiration();
}

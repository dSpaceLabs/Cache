<?php
/**
 * @copyright 2015 dSpace Labs LLC
 * @license MIT
 */

namespace Dspacelabs\Component\Cache;

/**
 * Cache Item Pool Interface
 */
interface CacheItemPoolInterface
{
    /**
     * @param string $key
     * @return \Dspacelabs\Component\CacheItemInterface
     * @throws \Dspacelabs\Component\InvalidArgumentException
     */
    public function getItem($key);

    /**
     * @param array $keys
     * @return array|\Traversable
     */
    public function getItems(array $keys = array());

    /**
     * @return boolean
     */
    public function clear();

    /**
     * @param array $keys
     */
    public function deleteItems(array $keys);

    /**
     * @param \Dspacelabs\Component\CacheItemInterface $item
     */
    public function save(CacheItemInterface $item);

    /**
     * @param \Dspacelabs\Component\CacheItemInterface $item
     */
    public function saveDeffered(CacheItemInterface $item);

    /**
     * @return boolean
     */
    public function commit();
}

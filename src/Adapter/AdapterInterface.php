<?php
/**
 * @copyright 2015 dSpace Labs LLC
 * @license MIT
 */

namespace Dspacelabs\Component\Cache\Adapter;

use Dspacelabs\Component\Cache\CacheItemInterface;

/**
 * Adapter Interface
 */
interface AdapterInterface
{
    /**
     * @param string $key
     *   The cache item's key
     *
     * @return \Dspacelabs\Component\Cache\CacheItemInterface|null
     */
    public function getItem($key);

    /**
     * @param string $key
     * @throws \Dspacelabs\Component\Cache\CacheException
     * @return boolean
     */
    public function deleteItem($key);

    /**
     * @param \Dspacelabs\Component\Cache\CacheItemInterface $item
     * @throws \Dspacelabs\Component\Cache\CacheException
     */
    public function saveItem(CacheItemInterface $item);

    /**
     * @throws \Dspacelabs\Component\Cache\CacheException
     * @return boolean
     */
    public function clear();

    /**
     * @return boolean
     *   Returns true if the key is found, false if the key is not found
     */
    public function exists($key);
}

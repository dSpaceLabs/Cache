<?php
/**
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
     * @return boolean
     */
    public function hasItem($key);

    /**
     * @param string $key
     * @return CacheItemInterface
     */
    public function getItem($key);

    /**
     * @param string $key
     * @throws CacheException
     */
    public function deleteItem($key);

    /**
     * @param CacheItemInterface $item
     * @throws CacheException
     */
    public function saveItem(CacheItemInterface $item);

    /**
     * @throws CacheException
     * @return void
     */
    public function clear();
}

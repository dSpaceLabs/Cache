<?php
/**
 */

namespace Dspacelabs\Component\Cache\Adapter;

use Dspacelabs\Component\Cache\CacheItemInterface;
use Dspacelabs\Component\Cache\CacheItem;

/**
 * Array Adapter
 *
 * Used to cache items for the duration of a script, can also be used for
 * testing
 */
class ArrayAdapter implements AdapterInterface
{
    /**
     * @var array
     */
    protected $items = array();

    /**
     * {@inheritDoc}
     */
    public function getItem($key)
    {
        if (!$this->hasItem($key)) {
            $this->items[$key] = new CacheItem($key);
        }

        return $this->items[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItem($key)
    {
        if ($this->hasItem($key)) {
            unset($this->items[$key]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function saveItem(CacheItemInterface $item)
    {
        $this->items[$item->getKey()] = $item;
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->items = array();
    }

    /**
     * {@inheritDoc}
     */
    public function hasItem($key)
    {
        return isset($this->items[$key]);
    }
}

<?php
/**
 * @copyright 2015 dSpace Labs LLC
 * @license MIT
 */

namespace Dspacelabs\Component\Cache;

use Dspacelabs\Component\Cache\InvalidArgumentException;
use Dspacelabs\Component\Cache\Adapter\AdapterInterface;

/**
 */
class CacheItemPool implements CacheItemPoolInterface
{
    /**
     * @var string
     */
    const VALID_KEY_PATTERN = '/^[a-zA-Z0-9_\.]+$/';

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var array
     */
    protected $toBeSaved = array();

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem($key)
    {
        if (false === $this->isValidKey($key)) {
            throw new InvalidArgumentException('Key is not valid format');
        }

        $item = $this->adapter->getItem($key);

        return $item;
    }

    /**
     * {@inheritDoc}
     */
    public function getItems(array $keys = array())
    {
        foreach ($keys as $key) {
            yield $this->getItem($key);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->adapter->clear();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItems(array $keys)
    {
        foreach ($keys as $key) {
            $this->adapter->deleteItem($key);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function save(CacheItemInterface $item)
    {
        $this->adapter->saveItem($item);
    }

    /**
     * {@inheritDoc}
     */
    public function saveDeffered(CacheItemInterface $item)
    {
        $this->toBeSaved[] = $item;
    }

    /**
     * {@inheritDoc}
     */
    public function commit()
    {
        foreach ($this->toBeSaved as $item) {
            $this->adapter->saveItem($item);
        }
    }

    /**
     * Key Validation
     *
     * @param string $key
     * @return boolean
     */
    protected function isValidKey($key)
    {
        $result = preg_match(self::VALID_KEY_PATTERN, $key);

        if (false === $result) {
            throw new CacheException('Something went wrong when trying to validate key.');
        }

        return (boolean) $result;
    }
}

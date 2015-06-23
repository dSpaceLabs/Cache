<?php
/**
 */

namespace Dspacelabs\Component\Cache;

use Dspacelabs\Component\Adapter\AdapterInterface;

/**
 */
class CacheItemPool implements CacheItemPoolInterface
{
    /**
     * @var string
     */
    const VALID_KEY_PATTERN = '[a-zA-Z0-9_\.]';

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var array
     */
    protected $toBeSaved = array();

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getItem($key)
    {
        if (!$this->isValidKey($key)) {
            throw new InvalidArgumentException('Key is not valid format');
        }

        $item = new CacheItem($key);

        return $item;
    }

    public function getItems(array $keys = array())
    {
        foreach ($keys as $key) {
            yield $this->getItem($key);
        }
    }

    public function clear()
    {
        $this->adapter->clear();
    }

    public function deleteItems(array $keys)
    {
        foreach ($keys as $key) {
            $this->adapter->deleteItem($key);
        }
    }

    public function save(CacheItemInterface $item)
    {
        $this->adapter->saveItem($item);
    }

    public function saveDeffered(CacheItemInterface $item)
    {
        $this->toBeSaved[] = $item;
    }

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

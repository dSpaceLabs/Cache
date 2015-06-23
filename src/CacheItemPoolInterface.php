<?php

namespace Dspacelabs\Component\Cache;

interface CacheItemPoolInterface
{
    public function getItem($key);
    public function getItems(array $keys = array());
    public function clear();
    public function deleteItems(array $keys);
    public function save(CacheItemInterface $item);
    public function saveDeffered(CacheItemInterface $item);
    public function commit();
}

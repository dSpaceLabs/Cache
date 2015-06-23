<?php

namespace Dspacelabs\Component\Cache;

interface CacheItemInterface
{
    public function getKey();
    public function get();
    public function set($value);
    public function isHit();
    public function exists();
    public function expiresAt($expiration);
    public function expiresAfter($time);
    public function getExpiration();
}

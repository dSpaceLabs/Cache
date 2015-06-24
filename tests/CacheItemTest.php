<?php
/**
 */

namespace Dspacelabs\Component\Cache\Tests;

use Dspacelabs\Component\Cache\CacheItem;

/**
 * @group item
 */
class CacheItemTest extends \PHPUnit_Framework_TestCase
{
    private $key = 'test';

    /**
     */
    protected function setUp()
    {
    }

    /**
     */
    public function test_getGet()
    {
        $item = new CacheItem($this->key);
        $this->assertSame($this->key, $item->getKey());
    }

    /**
     */
    public function test_get()
    {
        $item = new CacheItem($this->key);
        $this->assertNull($item->get());
    }

    /**
     * @dataProvider data_set
     */
    public function test_set($value)
    {
        $item = new CacheItem($this->key);
        $item->set($value);

        $this->assertSame($value, $item->get());
    }

    /**
     */
    public function data_set()
    {
        return array(
            array('test value'),
            array(array()),
            array(new \StdClass()),
        );
    }

    /**
     */
    public function teset_isHit()
    {
        $this->markTestIncomplete();
    }

    /**
     */
    public function test_exists()
    {
        $this->markTestIncomplete();
    }

    /**
     */
    public function test_getExpiration()
    {
        $this->markTestIncomplete();
    }

    /**
     */
    public function test_expiresAt()
    {
        $this->markTestIncomplete();
    }

    /**
     */
    public function test_expiresAfter()
    {
        $this->markTestIncomplete();
    }
}

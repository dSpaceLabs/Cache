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
    private $adapter;

    /**
     */
    protected function setUp()
    {
        $this->adapter = \Mockery::mock('Dspacelabs\Component\Cache\Adapter\AdapterInterface');
    }

    /**
     */
    public function test_getGet()
    {
        $item = new CacheItem($this->key, $this->adapter);
        $this->assertSame($this->key, $item->getKey());
    }

    /**
     */
    public function test_get()
    {
        $item = new CacheItem($this->key, $this->adapter);
        $this->assertNull($item->get());

        $item->set('test value');
        $this->assertSame('test value', $item->get());

        $item->expiresAt(new \DateTime(strtotime('-1 day')));
        $this->assertNull($item->get());
    }

    /**
     * @dataProvider data_set
     */
    public function test_set($value)
    {
        $item = new CacheItem($this->key, $this->adapter);
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
        $item = new CacheItem($this->key, $this->adapter);
        $this->assertTrue($item->isHit());
        $item->expiresAt(new \DateTime(strtotime('-1 day')));
        $this->assertFalse($item->isHit());
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
        $item = new CacheItem($this->key, $this->adapter);
        $this->assertInstanceOf('DateTime', $item->getExpiration());
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

<?php
/**
 */

namespace Dspacelabs\Component\Cache\Tests\Adapter;

use Dspacelabs\Component\Cache\Adapter\ArrayAdapter;

/**
 * @group adapter
 */
class ArrayAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayAdapter
     */
    private $adapter;

    /**
     */
    protected function setUp()
    {
        $this->adapter = new ArrayAdapter();
    }

    /**
     */
    public function test_saveItem()
    {
        $this->assertInstanceOf('Dspacelabs\Component\Cache\CacheItemInterface', $this->adapter->getItem('test'));

        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $item
            ->shouldReceive('getKey')->once()
            ->andReturn('test.key');

        $this->assertNull($this->adapter->saveItem($item));
    }

    /**
     */
    public function test_getItem()
    {
        $this->assertInstanceOf('Dspacelabs\Component\Cache\CacheItemInterface', $this->adapter->getItem('test'));
        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $item
            ->shouldReceive('getKey')
            ->andReturn('mock.test.key');
        $this->adapter->saveItem($item);

        $this->assertSame($item, $this->adapter->getItem('mock.test.key'));
    }

    /**
     */
    public function test_hasItem()
    {
        $this->assertFalse($this->adapter->hasItem('maybe'));
        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $item
            ->shouldReceive('getKey')
            ->andReturn('maybe');
        $this->adapter->saveItem($item);
        $this->assertTrue($this->adapter->hasItem('maybe'));
    }

    /**
     */
    public function test_clear()
    {
        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $item
            ->shouldReceive('getKey')
            ->andReturn('maybe');
        $this->adapter->saveItem($item);
        $this->assertTrue($this->adapter->hasItem('maybe'));
        $this->adapter->clear();
        $this->assertFalse($this->adapter->hasItem('maybe'));
    }

    /**
     */
    public function test_deleteItem()
    {
        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $item
            ->shouldReceive('getKey')
            ->andReturn('maybe');
        $this->adapter->saveItem($item);
        $this->assertTrue($this->adapter->hasItem('maybe'));
        $this->adapter->deleteItem('maybe');
        $this->assertFalse($this->adapter->hasItem('maybe'));
    }
}

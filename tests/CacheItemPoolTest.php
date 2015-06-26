<?php
/**
 */

namespace Dspacelabs\Component\Cache\Tests;

use Dspacelabs\Component\Cache\CacheItemPool;

/**
 * @group pool
 */
class CacheItemPoolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CacheItemPool
     */
    private $pool;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     */
    protected function setUp()
    {
        $this->adapter = \Mockery::mock('Dspacelabs\Component\Cache\Adapter\AdapterInterface');
        $this->pool    = new CacheItemPool($this->adapter);
    }

    /**
     * @dataProvider data_isValidKey
     */
    public function test_isValidKey($key, $isValid)
    {
        $pool = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemPool')
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $pool
            ->shouldReceive('isValidKey')
            ->passthru();

        $this->assertSame($isValid, $pool->isValidKey($key));
    }

    /**
     * Data Provider that contains the name of a key and a boolean if the key
     * is valid
     */
    public function data_isValidKey()
    {
        return array(
            array('key', true),
            array('${key}', false),
            array('!', false),
            array('k3y!', false),
        );
    }

    /**
     * @expectedException Dspacelabs\Component\Cache\InvalidArgumentException
     */
    public function test_getItem_throwException()
    {
        $this->pool->getItem('k3y!');
    }

    /**
     */
    public function test_getItem()
    {
        $mockItem = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $mockItem
            ->shouldReceive('getKey')
            ->andReturn('key.name');
        $this->adapter
            ->shouldReceive('getItem')->with('key.name')->once()
            ->andReturn($mockItem);

        $item = $this->pool->getItem('key.name');
        $this->assertInstanceOf('Dspacelabs\Component\Cache\CacheItemInterface', $item);
        $this->assertSame($mockItem, $item);
    }

    /**
     */
    public function test_getItems()
    {
        $keys = array(
            'key.one',
            'key.two',
        );

        $mockItem = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $mockItem
            ->shouldReceive('getKey')
            ->andReturnValues($keys);

        $this->adapter
            ->shouldReceive('getItem')
            ->andReturn($mockItem);

        $items = $this->pool->getItems($keys);
        for ($i = 0; $items->valid(); $i++, $items->next()) {
            $item = $items->current();
            $this->assertInstanceOf('Dspacelabs\Component\Cache\CacheItemInterface', $item);
            $this->assertSame($keys[$items->key()], $item->getKey());
        }
    }

    /**
     */
    public function test_clear()
    {
        $this->adapter
            ->shouldReceive('clear');
        $this->pool->clear();
    }

    /**
     */
    public function test_deleteItems()
    {
        $this->adapter
            ->shouldReceive('deleteItem')->twice();

        $this->pool->deleteItems(array('test.key', 'key.two'));
    }

    /**
     */
    public function test_save()
    {
        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $this->adapter
            ->shouldReceive('saveItem')->once()
            ->with($item);

        $this->pool->save($item);
    }

    /**
     */
    public function test_saveDeffered()
    {
        $item = \Mockery::mock('Dspacelabs\Component\Cache\CacheItemInterface');
        $this->adapter
            ->shouldReceive('saveItem')->once()
            ->with($item);

        $this->pool->saveDeffered($item);
        $this->pool->commit();
    }

    /**
     */
    public function test_commit()
    {
        $this->markTestIncomplete();
    }
}

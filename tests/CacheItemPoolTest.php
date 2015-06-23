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
            ->makePartial();

        $this->assertSame($isValid, $pool->isValidKey($key));
    }

    /**
     */
    public function data_isValidKey()
    {
        return array(
            array('key', true),
            array('${key}', false),
        );
    }

    /**
     */
    public function test_getItem()
    {
    }

    /**
     */
    public function test_getItems()
    {
    }

    /**
     */
    public function test_clear()
    {
    }

    /**
     */
    public function test_deleteItems()
    {
    }

    /**
     */
    public function test_save()
    {
    }

    /**
     */
    public function test_saveDeffered()
    {
    }

    /**
     */
    public function test_commit()
    {
    }
}

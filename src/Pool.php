<?php declare(strict_types=1);
namespace Swoft\Mongo;

use ReflectionException;
use Swoft\Bean\BeanFactory;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Connection\Pool\AbstractPool;
use Swoft\Connection\Pool\Contract\ConnectionInterface;
use Throwable;

/**
 * Class Pool
 * @since 2.0
 * @package Swoft\Mongodb
 */
class Pool extends AbstractPool
{

    /**
     * Default pool name
     */
    const DEFAULT_POOL = 'mgsql.pool';

    /**
     * Database
     *
     * @var MongoDb
     */
    protected $mongoDb;


    public function getConnection(): ConnectionInterface
    {
        $connection = parent::getConnection();
        $dbSelector = $this->mongoDb->getDbSelector();

        /* @var Connection $connection select db */
        if (!empty($dbSelector)) {
            $dbSelector->select($connection);
        }

        return $connection;
    }


    /**
     * Create connection
     *
     * @return ConnectionInterface
     * @throws DbException
     */
    public function createConnection(): ConnectionInterface
    {
        return $this->mongoDb->createConnection($this);
    }

    /**
     * @return MongoDb
     */
    public function getDatabase(): MongoDb
    {
        return $this->mongoDb;
    }
}

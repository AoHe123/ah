<?php declare(strict_types=1);
namespace Swoft\Mongo;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Mongo\Connection\Connection;
use Swoft\Mongo\Connector\MongoConnector;
use Swoft\Mongo\Contract\DbSelectorInterface;
use Swoft\Mongo\Exception\MongoException;
use Swoft\Stdlib\Helper\Arr;
use function bean;
use ReflectionException;

/**
 * Class MongoDb
 */
class MongoDb
{
    /**
     * Php mongo
     */
    const PHP_MONGO  = 'mongo';

    /**
     * @var string
     */
    private $driver = self::PHP_MONGO;

    /**
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * @var int
     */
    private $port = 27017;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $user = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var float
     */
    private $timeout = 0.0;

    /**
     * @var array
     */
    protected $connections = [];

    /**
     * Db selector
     *
     * @var DbSelectorInterface
     */
    protected $dbSelector;

    /**
     * @var string
     */
    protected $replica = '';

    /**
     * @return DbSelectorInterface
     */
    public function getDbSelector(): ?DbSelectorInterface
    {
        return $this->dbSelector;
    }
    /**
     * @param Pool $pool
     * @throws MongoException
     * @return Connection
     */
    public function createConnection(Pool $pool): Connection
    {
        $connection = $this->getConnection();
        $connection->initialize($pool, $this);
        $connection->create();

        return $connection;
    }

    /**
     * Get connection
     *
     * @return Connection
     * @throws MongoException
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function getConnector(): Connection
    {
        $driver      = $this->getDriver();
        $connections =Arr::merge($this->defaultConnections(), $this->connections);
        $connection  = $connections[$driver] ?? null;

        if (!$connection instanceof Connection) {
            throw new MongoException(sprintf('Connection(dirver=%s) is not exist', $driver));
        }

        return $connection;
    }

    /**
     * Get connection
     *
     * @return Connection
     * @throws MongoException
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function getConnection(): Connection
    {
        $driver      = $this->getDriver();
        $connections =Arr::merge($this->defaultConnectors(), $this->connections);
        $connection  = $connections[$driver] ?? null;

        if (!$connection instanceof Connection) {
            throw new MongoException(sprintf('Connection(dirver=%s) is not exist', $driver));
        }

        return $connection;
    }

    /**
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function defaultConnectors(): array
    {
        return [
            self::PHP_MONGO => bean(MongoConnector::class)
        ];
    }

    /**
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function defaultConnections(): array
    {
        return [
            self::PHP_MONGO => bean(MongoConnector::class)
        ];
    }
    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUserName(string $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getDatabaseName(): string
    {
        return $this->database;
    }

    /**
     * @param string $database
     */
    public function setDatabaseName(string $database)
    {
        $this->database = $database;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     */
    public function setDriver(string $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function toArray(): array
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getName(): string
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getUri(): array
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isUseProvider(): bool
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getBalancer(): string
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getProvider(): string
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getMaxWait(): int
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }


    /**
     * @return int
     * @throws \Exception
     */
    public function getMaxIdleTime(): int
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getMaxWaitTime(): int
    {
        throw new \Exception(__CLASS__.__FUNCTION__.'not complete');
    }

    /**
     * @return string
     */
    public function getReplica(): string
    {
        return $this->replica;
    }

    /**
     * @param string $replica
     */
    public function setReplica(string $replica)
    {
        $this->replica = $replica;
    }

}

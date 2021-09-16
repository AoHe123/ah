<?php declare(strict_types=1);


namespace Swoft\Mongo\Connection;

use ReflectionException;
use Swoft;
use Swoft\Bean\BeanFactory;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Connection\Pool\AbstractConnection;
use Swoft\Log\Helper\Log;
use Swoft\Mongo\Pool;
use Swoft\Mongo\Mongodb;
use Swoft\Mongo\Contract\ConnectionInterface;
use Swoft\Stdlib\Helper\PhpHelper;
use Throwable;

/**
 * Class Connection
 *
 * @since 2.0
 */
abstract class Connection extends AbstractConnection implements ConnectionInterface
{
    /**
     * @var Mongosql
     */
    protected $client;

    /**
     * @var mgResource
     */
    protected $mgresource;

    /**
     * @var Mongodb
     */
    protected $Mongodb;


    /**
     * @param Pool    $pool
     * @param Mongodb $mongodb
     */
    public function initialize(Pool $pool, Mongodb $mongodb)
    {
        $this->pool     = $pool;
        $this->Mongodb  = $mongodb;

        $this->id = $this->pool->getConnectionId();
    }

    /**
     *
     */
    public function create(): void
    {
        $this->createClient();
    }

    /**
     * @param bool $boolmgResource
     */
    public function createClient(bool $boolmgResource = false): void
    {
        $config = [
            'host'           => $this->Mongodb->getHost(),
            'port'           => $this->Mongodb->getPort(),
            'user'           => $this->Mongodb->getUserName(),
            'password'       => $this->Mongodb->getPassword(),
            'database'       => $this->Mongodb->getDatabaseName(),
            'timeout'        => $this->Mongodb->getTimeout()
        ];

        if ($boolmgResource == false) {
            $this->client = $this->Mongodb->getConnector()->connect($config);
        } else {
            $this->pgresource = $this->Mongodb->getConnector()->pgConnect($config);
        }
    }

}


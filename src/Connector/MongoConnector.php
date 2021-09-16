<?php declare(strict_types=1);
namespace Swoft\Mongo\Connector;
use MongoDB\Driver\{
    BulkWrite, Command, Manager, Query, WriteConcern
};
use MongoDB\Driver\Exception\{
    AuthenticationException, ConnectionException, Exception, InvalidArgumentException, RuntimeException
};
use Swoft\Mongo\Contract\ConnectorInterface;
use Swoft\Mongo\Exception\MongoException;

class MongoConnector implements ConnectorInterface{

    /**
     * @param array $config
     *
     * @return Manager|Object
     * @throws MongoException
     */
    public function connect(array $config)
    {
        try {
            $username = $config['user'];
            $password = $config['password'];
            if (!empty($username) && !empty($password)) {
                $uri = sprintf(
                    'mongodb://%s:%s@%s:%d/%s',
                    $config['user'],
                    $config['password'],
                    $config['host'],
                    $config['port'],
                    $config['database']
                );
            } else {
                $uri = sprintf(
                    'mongodb://%s:%d/%s',
                    $config['host'],
                    $config['port'],
                    $config['database']
                );
            }
            $urlOptions = [];
            //数据集
            $replica =  $config['replica'];
            if ($replica) {
                $urlOptions['replicaSet'] = $replica;
            }
            return new Manager($uri, $urlOptions);
        } catch (InvalidArgumentException $e) {
            throw MongoException::managerError('mongo 连接参数错误:' . $e->getMessage());
        } catch (RuntimeException $e) {
            throw MongoException::managerError('mongo uri格式错误:' . $e->getMessage());
        }
    }
}

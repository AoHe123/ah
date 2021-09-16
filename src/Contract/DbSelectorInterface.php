<?php declare(strict_types=1);


namespace Swoft\Mongo\Contract;
use Swoft\Mongo\Connection\Connection;

/**
 * Class DbSelectorInterface
 *
 * @since 2.0
 */
interface DbSelectorInterface
{
    /**
     * @param Connection $connection
     */
    public function select(Connection $connection): void;
}

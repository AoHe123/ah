<?php declare(strict_types=1);


namespace Swoft\Mongo\Exception;

use Exception;

/**
 * Class PgsqlException
 *
 * @since 2.0
 */
class MongoException extends Exception
{
    /**
     * @param string $msg
     * @throws MongoException
     */
    public static function managerError(string $msg)
    {
        throw new self($msg);
    }
}

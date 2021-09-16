<?php declare(strict_types=1);


namespace Swoft\Mongo\Contract;



/**
 * Class ConnectorInterface
 *
 * @since 2.0
 */
interface ConnectorInterface
{
    /**
     * Establish a database connection.
     *
     * @param  array $config
     *
     * @return Object
     */
    public function connect(array $config);
}

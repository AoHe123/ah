<?php declare(strict_types=1);


namespace Swoft\Mongo\Contract;

/**
 * Class ConnectionInterface
 *
 * @since 2.0
 */
interface ConnectionInterface
{
    /**
     * Create client
     */
    public function createClient(): void;
}

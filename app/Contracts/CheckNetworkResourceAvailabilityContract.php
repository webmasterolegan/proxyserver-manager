<?php

namespace App\Contracts;

use Illuminate\Container\Attributes\Singleton;

/**
 * Контракт для проверки актиности сетевого ресурса
 */
#[Singleton]
interface CheckNetworkResourceAvailabilityContract
{
    /**
     * Проверить активность сетевого ресурса
     * 
     * @param int $port
     * @param string $ipAddress
     * 
     * @return bool
     */
    public function __invoke(int $port, string $ipAddress): bool;
}

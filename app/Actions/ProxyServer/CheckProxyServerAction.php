<?php

namespace App\Actions\ProxyServer;

use App\Contracts\ProxyServer\CheckProxyServerContract;
use App\Models\ProxyServer;
use App\Contracts\CheckNetworkResourceAvailabilityContract;

/**
 * Проверка доступности прокси сервера
 */
final readonly class CheckProxyServerAction implements CheckProxyServerContract
{
    public function __construct(
        private CheckNetworkResourceAvailabilityContract $checkNetworkResourceAvailabilityService
    ) {}
    
    /**
     * Проверить доступность прокси сервера
     * 
     * @param ProxyServer $proxyServer
     * 
     * @return void
     */
    public function __invoke(ProxyServer $proxyServer): void
    {
        $isActive = $this->checkNetworkResourceAvailabilityService->__invoke(
            $proxyServer->port,
            $proxyServer->ip_address
        );

        $proxyServer->update([
            'is_active' => $isActive,
            'last_checked_at' => now(),
        ]);
    }
}

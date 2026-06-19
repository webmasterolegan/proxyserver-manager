<?php

namespace App\Contracts\ProxyServer;

use App\Models\ProxyServer;

/**
 * Контракт для проверки доступности прокси сервера
 */
interface CheckProxyServerContract
{
    /**
     * Проверить доступность прокси сервера
     * 
     * @param ProxyServer $proxyServer
     * 
     * @return void
     */
    public function __invoke(ProxyServer $proxyServer): void;
}

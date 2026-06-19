<?php

namespace App\Contracts\ProxyServer;

use App\Models\ProxyServer;

/**
 * Контракт для удаления прокси сервера
 */
interface DeleteProxyServerContract
{
    /**
     * Удалить прокси сервер
     * 
     * @param ProxyServer $proxyServer
     * 
     * @return void
     */
    public function __invoke(ProxyServer $proxyServer): void;
}

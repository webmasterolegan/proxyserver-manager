<?php

namespace App\Actions\ProxyServer;

use App\Models\ProxyServer;
use App\Contracts\ProxyServer\DeleteProxyServerContract;

/**
 * Удаление прокси сервера
 */
final readonly class DeleteProxyServerAction implements DeleteProxyServerContract
{
    /**
     * Удалить прокси сервер
     * 
     * @param ProxyServer $proxyServer
     * 
     * @return void
     */
    public function __invoke(ProxyServer $proxyServer): void
    {
        $proxyServer->delete();
    }
}

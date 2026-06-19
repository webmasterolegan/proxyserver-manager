<?php

namespace App\Contracts\ProxyServer;

use App\Dto\ProxyServerRequestDto;
use App\Models\ProxyServer;

/**
 * Контракт для обновления прокси сервера
 */
interface UpdateProxyServerContract
{
    /**
     * Обновить прокси сервер
     * 
     * @param ProxyServerRequestDto $requestDto
     * @param ProxyServer $proxyServer
     * 
     * @return ProxyServer
     */
    public function __invoke(
        ProxyServerRequestDto $requestDto,
        ProxyServer $proxyServer
    ): ProxyServer;
}

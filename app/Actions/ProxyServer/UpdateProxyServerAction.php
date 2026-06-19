<?php

namespace App\Actions\ProxyServer;

use App\Dto\ProxyServerRequestDto;
use App\Contracts\ProxyServer\UpdateProxyServerContract;
use App\Models\ProxyServer;

/**
 * Обновление прокси сервера
 */
final readonly class UpdateProxyServerAction implements UpdateProxyServerContract
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
    ): ProxyServer
    {
        $proxyServer->update($requestDto->toArray());
        
        return $proxyServer;
    }
}

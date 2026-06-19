<?php

namespace App\Actions\ProxyServer;

use App\Dto\ProxyServerRequestDto;
use App\Contracts\ProxyServer\CreateProxyServerContract;
use App\Models\ProxyServer;

/**
 * Создание прокси сервера
 */
final readonly class CreateProxyServerAction implements CreateProxyServerContract
{
    /**
     * Создать прокси сервер
     * 
     * @param ProxyServerRequestDto $requestDto
     * @return ProxyServer
     */
    public function __invoke(ProxyServerRequestDto $requestDto): ProxyServer
    {
        return ProxyServer::create($requestDto->toArray());
    }
}

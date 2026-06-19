<?php

namespace App\Contracts\ProxyServer;

use App\Dto\ProxyServerRequestDto;
use App\Models\ProxyServer;

/**
 * Контракт для создания прокси сервера
 */
interface CreateProxyServerContract
{
    /**
     * Создать прокси сервер
     * 
     * @param ProxyServerRequestDto $requestDto
     * 
     * @return ProxyServer
     */
    public function __invoke(ProxyServerRequestDto $requestDto): ProxyServer;
}

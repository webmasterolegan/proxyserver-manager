<?php

namespace App\Http\Controllers\Api\ProxyServer;

use App\Models\ProxyServer;
use App\Contracts\ProxyServer\DeleteProxyServerContract;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер для удаления прокси сервера
 */
final readonly class DeleteProxyServerController
{
    /**
     * Удалить прокси сервер
     * 
     * @param ProxyServer $proxyServer
     * @param DeleteProxyServerContract $deleteProxyServerAction
     * 
     * @return JsonResponse
     */
    public function __invoke(
        ProxyServer $proxyServer,
        DeleteProxyServerContract $deleteProxyServerAction
    ): JsonResponse
    {
        $deleteProxyServerAction($proxyServer);

        return response()->json(status: 200);
    }
}

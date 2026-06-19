<?php

namespace App\Http\Controllers\Api\ProxyServer;

use App\Models\ProxyServer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Контроллер для получения списка прокси серверов
 */
final readonly class GetProxyServersListController
{
    /**
     * Получить список прокси серверов
     * 
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection|JsonResponse
    {
        $proxyServers = ProxyServer::all()->sortByDesc('created_at');

        if ($proxyServers->isEmpty()) {
            return response()->json(status: 204);
        }

        return $proxyServers->toResourceCollection();
    }
}

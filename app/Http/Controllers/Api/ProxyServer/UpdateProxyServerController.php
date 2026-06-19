<?php

namespace App\Http\Controllers\Api\ProxyServer;

use App\Http\Requests\CreateOrUpdateProxyServerRequest;
use App\Contracts\ProxyServer\UpdateProxyServerContract;
use App\Dto\ProxyServerRequestDto;
use Illuminate\Http\JsonResponse;
use App\Models\ProxyServer;

/**
 * Контроллер для обновления прокси сервера
 */
final readonly class UpdateProxyServerController
{
    /**
     * Обновить прокси сервер
     * 
     * @param ProxyServer $proxyServer
     * @param CreateOrUpdateProxyServerRequest $request
     * @param UpdateProxyServerContract $updateProxyServerAction
     * 
     * @return JsonResponse
     */
    public function __invoke(
        ProxyServer $proxyServer,
        CreateOrUpdateProxyServerRequest $request,
        UpdateProxyServerContract $updateProxyServerAction
    ): JsonResponse
    {
        $validatedData = $request->validated();
        $updatedProxyServer = $updateProxyServerAction(
            ProxyServerRequestDto::fromArray($validatedData),
            $proxyServer
        );

        return response()->json(
            status: 200,
            data: $updatedProxyServer->toResource()
        );
    }
}

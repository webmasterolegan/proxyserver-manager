<?php

namespace App\Http\Controllers\Api\ProxyServer;

use App\Http\Requests\CreateOrUpdateProxyServerRequest;
use App\Contracts\ProxyServer\CreateProxyServerContract;
use App\Dto\ProxyServerRequestDto;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер для создания прокси сервера
 */
final readonly class CreateProxyServerController
{
    /**
     * Создать прокси сервер
     * 
     * @param CreateOrUpdateProxyServerRequest $request
     * @param CreateProxyServerContract $createProxyServerAction
     * 
     * @return JsonResponse
     */
    public function __invoke(
        CreateOrUpdateProxyServerRequest $request,
        CreateProxyServerContract $createProxyServerAction
    ): JsonResponse
    {
        $validatedData = $request->validated();
        $createdProxyServer = $createProxyServerAction(ProxyServerRequestDto::fromArray($validatedData));

        return response()->json(
            status: 201,
            data: $createdProxyServer->toResource()
        );
    }
}

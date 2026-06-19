<?php

namespace App\Providers;

use App\Services\CheckNetworkResourceAvailabilityService;
use App\Contracts\CheckNetworkResourceAvailabilityContract;
use App\Actions\ProxyServer\CreateProxyServerAction;
use App\Actions\ProxyServer\UpdateProxyServerAction;
use App\Actions\ProxyServer\DeleteProxyServerAction;
use App\Contracts\ProxyServer\CreateProxyServerContract;
use App\Contracts\ProxyServer\UpdateProxyServerContract;
use App\Actions\ProxyServer\CheckProxyServerAction;
use App\Contracts\ProxyServer\CheckProxyServerContract;
use App\Contracts\ProxyServer\DeleteProxyServerContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ProxyServerServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        CheckNetworkResourceAvailabilityContract::class => CheckNetworkResourceAvailabilityService::class,
        CreateProxyServerContract::class => CreateProxyServerAction::class,
        UpdateProxyServerContract::class => UpdateProxyServerAction::class,
        CheckProxyServerContract::class => CheckProxyServerAction::class,
        DeleteProxyServerContract::class => DeleteProxyServerAction::class,
    ];

    public function provides(): array
    {
        return [
            CheckNetworkResourceAvailabilityContract::class,
            CreateProxyServerContract::class,
            UpdateProxyServerContract::class,
            CheckProxyServerContract::class,
            DeleteProxyServerContract::class,
        ];
    }
}

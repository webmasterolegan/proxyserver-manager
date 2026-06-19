<?php

namespace App\Console\Commands;

use App\Models\ProxyServer;
use App\Jobs\CheckProxyServerJob;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

/**
 * Проверка доступности всех прокси серверов из БД
 */
#[Signature('app:check-all-proxy-servers')]
#[Description('Проверка доступности всех прокси серверов из БД')]
class CheckAllProxyServersCommand extends Command
{
    /**
     * Выполнить команду
     * 
     * @return void
     */
    public function handle(): void
    {
        ProxyServer::all()->each(fn (ProxyServer $proxyServer) => CheckProxyServerJob::dispatch($proxyServer));
    }
}

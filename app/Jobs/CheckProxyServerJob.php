<?php

namespace App\Jobs;

use App\Models\ProxyServer;
use App\Contracts\ProxyServer\CheckProxyServerContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

/**
 * Задание на проверку доступности прокси сервера
 */
class CheckProxyServerJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Количество секунд, по истечении которых уникальная блокировка задания будет снята.
     *
     * @var int
     */
    public $uniqueFor = 3600;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private ProxyServer $proxyServer
    ) {}

    /**
     * Получить ключ уникальности для задания.
     *
     * @return string
     */
    public function uniqueId(): string
    {
        return 'check-proxy-server:'.$this->proxyServer->id;
    }

    /**
     * Выполнить задание
     * 
     * @param CheckProxyServerContract $checkProxyServerAction
     * 
     * @return void
     */
    public function handle(CheckProxyServerContract $checkProxyServerAction): void
    {
        $checkProxyServerAction($this->proxyServer);
    }
}

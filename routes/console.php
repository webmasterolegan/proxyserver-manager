<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\CheckAllProxyServersCommand;

/**
 * Проверка доступности всех прокси серверов каждые 5 минут
 */
Schedule::command(CheckAllProxyServersCommand::class)->everyFiveMinutes();

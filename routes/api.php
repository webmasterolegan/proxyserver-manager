<?php

use App\Http\Controllers\Api\ProxyServer\CreateProxyServerController;
use App\Http\Controllers\Api\ProxyServer\UpdateProxyServerController;
use App\Http\Controllers\Api\ProxyServer\GetProxyServersListController;
use App\Http\Controllers\Api\ProxyServer\DeleteProxyServerController;
use Illuminate\Support\Facades\Route;

/**
 * Получение списка всех прокси серверов
 */
Route::get('/proxy-servers', GetProxyServersListController::class)->name('proxy-servers.list');

/**
 * Создание прокси сервера
 */
Route::post('/proxy-servers', CreateProxyServerController::class)->name('proxy-servers.create');

/**
 * Обновление прокси сервера
 */
Route::put('/proxy-servers/{proxyServer}', UpdateProxyServerController::class)->name('proxy-servers.update');

/**
 * Удаление прокси сервера
 */
Route::delete('/proxy-servers/{proxyServer}', DeleteProxyServerController::class)->name('proxy-servers.delete');
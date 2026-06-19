<?php

use App\Models\ProxyServer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('API: Создание прокси сервера', function () {
    $proxyServers = json_decode(file_get_contents(base_path('stubs/proxy_servers.json')), true);

    $response = $this->postJson(route('proxy-servers.create'), ['is_active' => false, ...$proxyServers[0]]);

    $response->assertStatus(201);
    $response->assertJsonFragment($proxyServers[0]);

    $this->assertDatabaseHas('proxy_servers', $proxyServers[0]);
});

test('API: Получение списка прокси серверов (список не пуст)', function () {
    $this->seed();

    $response = $this->getJson(route('proxy-servers.list'));
    $responseData = $response->json();

    $response->assertStatus(200);
    $this->assertCount(ProxyServer::count(), $responseData);
});

test('API: Получение списка прокси серверов (список пуст)', function () {
    $response = $this->getJson(route('proxy-servers.list'));

    $response->assertStatus(204);
    $this->assertEmpty($response->getContent());
});

test('API: Обновление прокси сервера (успешное обновление)', function () {
    $this->seed();

    $proxyServerBeforeUpdate = ProxyServer::select('id', 'is_active', 'port', 'ip_address', 'type')
        ->first()
        ->toArray();
    $proxyServerIsActiveAfterUpdate = !$proxyServerBeforeUpdate['is_active'];

    $response = $this->putJson(
            route('proxy-servers.update', $proxyServerBeforeUpdate['id']),
            [...$proxyServerBeforeUpdate, 'is_active' => $proxyServerIsActiveAfterUpdate]
        );

    $response->assertStatus(200);
    $response->assertJsonFragment([
        'is_active' => $proxyServerIsActiveAfterUpdate,
    ]);

    $this->assertDatabaseHas('proxy_servers', [
        'id' => $proxyServerBeforeUpdate['id'],
        'is_active' => $proxyServerIsActiveAfterUpdate,
    ]);
});

test('API: Обновление прокси сервера (ошибка валидации)', function () {
    $this->seed();

    $proxyServerBeforeUpdate = ProxyServer::select('id', 'is_active', 'port', 'ip_address', 'type')
        ->first()
        ->toArray();

    $response = $this->putJson(
        route('proxy-servers.update', $proxyServerBeforeUpdate['id']),
        [...$proxyServerBeforeUpdate, 'ip_address' => 'string']
    );

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('ip_address');
});

test('API: Удаление прокси сервера', function () {
    $this->seed();

    $proxyServer = ProxyServer::select('id')
        ->first()
        ->toArray();

    $response = $this->deleteJson(route('proxy-servers.delete', $proxyServer['id']));

    $response->assertStatus(200);
    $this->assertDatabaseMissing('proxy_servers', $proxyServer);
});
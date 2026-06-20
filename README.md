# Proxy Server Manager

### Простое приложение управления списком Proxy серверов с автоматической проверкой доступности

Backend [Laravel 13](https://laravel.com/docs/13.x)

Frontend [Vue3](https://vuejs.org/)

Для локальной разработки использовался стандартный пакет Laravel [Sail](https://laravel.com/docs/13.x/sail) для упрощёного создания Docker контейнера


Проверка доступности осуществляется каждые 5 минут:

1) Планировщик выполняет команду [App/Console/Commands/CheckAllProxyServersCommand](https://github.com/webmasterolegan/proxyserver-manager/blob/master/app/Console/Commands/CheckAllProxyServersCommand.php)

```
php artisan app:check-all-proxy-servers
```

2) Команда получает список Proxy серверов из БД и для проверки каждого ставит задачу в очередь, используя сервис [App\Services\CheckNetworkResourceAvailabilityService](https://github.com/webmasterolegan/proxyserver-manager/blob/master/app/Services/CheckNetworkResourceAvailabilityService.php)

## Заполнение отладочными данными
```
php artisan db:seed
```

## Запус автотестов

```
php artisan test
```


### Контейнер уже настроен на запуск планировщика и выполнение очереди в 4 потока

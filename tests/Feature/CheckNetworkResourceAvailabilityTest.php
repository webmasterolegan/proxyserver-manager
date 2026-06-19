<?php

use App\Services\CheckNetworkResourceAvailabilityService;

test('Выброс исключения при некорректном IP-адресе', function () {
    $service = new CheckNetworkResourceAvailabilityService;

    expect(fn () => $service(8080, 'not-an-ip'))
        ->toThrow(Exception::class);
});

test('127.0.0.1:80 Доступен', function () {
    $service = new CheckNetworkResourceAvailabilityService;

    expect($service(80, '127.0.0.1'))->toBeTrue();
});

test('127.0.0.1:1 Недоступен', function () {
    $service = new CheckNetworkResourceAvailabilityService;

    expect($service(1, '127.0.0.1'))->toBeFalse();
});
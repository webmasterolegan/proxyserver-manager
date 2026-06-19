<?php

namespace App\Services;

use App\Contracts\CheckNetworkResourceAvailabilityContract;
use Illuminate\Support\Facades\Context;
use Exception;

/**
 * Сервис для проверки актиности сетевого ресурса
 */
final readonly class CheckNetworkResourceAvailabilityService implements CheckNetworkResourceAvailabilityContract
{
    private const int TIMEOUT = 10;
    
    /**
     * Проверить активность сетевого ресурса
     * 
     * @param int $port
     * @param string $ipAddress
     * 
     * @throws Exception
     * 
     * @return bool
     */
    public function __invoke(
        int $port,
        string $ipAddress,
    ): bool
    {
        Context::add('checkNetworkResourceAvailability.ipAddress', $ipAddress);
        Context::add('checkNetworkResourceAvailability.port', $port);
        Context::add('checkNetworkResourceAvailability.timeout', self::TIMEOUT);

        if (!filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            throw new Exception("Некорректный IP-адрес: {$ipAddress}");
        } 

        $connection = @fsockopen($ipAddress, $port, $errno, $errstr, self::TIMEOUT);

        if (is_resource($connection)) {
            fclose($connection);

            return true;
        }

        return false;
    }
}

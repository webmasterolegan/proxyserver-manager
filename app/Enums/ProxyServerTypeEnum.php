<?php

namespace App\Enums;

/**
 * Типы прокси серверов
 */
enum ProxyServerTypeEnum: string
{
    case HTTP = 'http';
    case HTTPS = 'https';
    case SOCKS5 = 'socks5';

    /**
     * Все типы прокси серверов
     * 
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Описание типа прокси сервера (Для UI)
     * 
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::HTTP => 'HTTP Proxy',
            self::HTTPS => 'HTTPS Proxy',
            self::SOCKS5 => 'SOCKS5 Proxy',
        };
    }
}

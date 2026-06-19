<?php

namespace App\Dto;

use App\Enums\ProxyServerTypeEnum;

/**
 * DTO прокси сервера (Запрос)
 * 
 * @property bool $is_active
 * @property int $port
 * @property string $ip_address
 * @property ProxyServerTypeEnum $type
 */
final readonly class ProxyServerRequestDto
{
    public function __construct(
        public readonly bool $is_active,
        public readonly int $port,
        public readonly string $ip_address,
        public readonly ProxyServerTypeEnum $type,
    ) {}

    /**
     * Создать DTO из массива
     * 
     * @param array $data
     * 
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['is_active'] ?? false,
            $data['port'],
            $data['ip_address'],
            ProxyServerTypeEnum::from($data['type']),
        );
    }

    /**
     * Преобразовать DTO в массив
     * 
     * @return array
     */
    public function toArray(): array
    {
        return [
            'is_active' => $this->is_active,
            'port' => $this->port,
            'ip_address' => $this->ip_address,
            'type' => $this->type,
        ];
    }
}
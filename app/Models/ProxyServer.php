<?php

namespace App\Models;

use App\Enums\ProxyServerTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * Модель прокси сервера
 * 
 * @property int $id
 * @property bool $is_active
 * @property ProxyServerTypeEnum $type
 * @property int $port
 * @property string $ip_address
 * @property Carbon|null $last_checked_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['is_active', 'type', 'port', 'ip_address', 'last_checked_at'])]
class ProxyServer extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'type' => ProxyServerTypeEnum::class,
            'port' => 'integer',
            'last_checked_at' => 'datetime',
        ];
    }
}

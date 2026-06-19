<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Прокси сервер ресурс для ответа в API
 */
class ProxyServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_active' => $this->is_active,
            'type' => $this->type->value,
            'port' => $this->port,
            'ip_address' => $this->ip_address,
            'last_checked_at' => $this->last_checked_at?->format('H:i:s d.m.Y'),
            'created_at' => $this->created_at->format('H:i:s d.m.Y'),
            'updated_at' => $this->updated_at->format('H:i:s d.m.Y'),
        ];
    }
}

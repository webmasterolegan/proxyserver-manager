<?php

namespace App\Http\Requests;

use App\Enums\ProxyServerTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Запрос на создание или редактирование прокси сервера
 */
class CreateOrUpdateProxyServerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean',
            'port' => 'required|integer|min:1|max:65535',
            'ip_address' => [
                'required',
                'ip',
                Rule::unique('proxy_servers', 'ip_address')
                    ->ignore($this->route('proxyServer')?->id ?? null),
            ],
            'type' => [
                'required',
                'string',
                Rule::in(ProxyServerTypeEnum::values()),
            ],
        ];
    }   
}

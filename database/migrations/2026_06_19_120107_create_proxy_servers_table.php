<?php

use App\Enums\ProxyServerTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proxy_servers', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
            $table->enum('type', ProxyServerTypeEnum::values())->default(ProxyServerTypeEnum::HTTP->value);
            $table->unsignedSmallInteger('port');
            $table->ipAddress('ip_address')->unique();
            $table->dateTime('last_checked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxy_servers');
    }
};

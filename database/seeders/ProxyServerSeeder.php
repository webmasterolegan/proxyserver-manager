<?php

namespace Database\Seeders;

use App\Models\ProxyServer;
use Illuminate\Database\Seeder;

class ProxyServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proxyServers = json_decode(file_get_contents(base_path('stubs/proxy_servers.json')), true);

        ProxyServer::upsert($proxyServers, ['ip_address'], ['port', 'type']);
    }
}

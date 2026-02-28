<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::updateOrCreate(
            ['domain' => 'tenant1'],
            ['name' => 'Tenant 1']
        );
        
        Tenant::updateOrCreate(
            ['domain' => 'tenant2'],
            ['name' => 'Tenant 2']
        );
    }
}
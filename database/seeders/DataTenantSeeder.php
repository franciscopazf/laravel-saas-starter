<?php

namespace Database\Seeders;

use App\Clases\Users\CreateUserFromTenant;
use App\Livewire\Tenants\Usuarios\Usuarios\CreateUserTenant;
use App\Models\User;
use App\Models\Usuarios\UserInTenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CreateUserFromTenant::makeUserTenant(
            "Admin",
            env('MAIL_ADMIN_ADDRESS'),
            tenant()
        )->create();
    }
}

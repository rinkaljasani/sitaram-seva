<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Schema::enableForeignKeyConstraints();
        $admins = [
            'full_name' => 'Admin',
            'email' => "admin@admin.com",
            'contact_no' => '1234567890',
            'password' => \Hash::make('!@#$%^@admin'),
            'permissions' => serialize(getPermissions('admin')),
            'is_active' => 'y',
            'type' => 'admin',
            'profile' => NULL,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ];

        Admin::create($admins);
    }
}

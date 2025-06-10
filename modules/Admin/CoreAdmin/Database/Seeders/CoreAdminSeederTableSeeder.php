<?php

namespace Modules\Admin\CoreAdmin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\CoreAdmin\Models\Admin;
use Modules\Admin\CoreAdmin\Models\User;
use Ranium\SeedOnce\Traits\SeedOnce;

class CoreAdminSeederTableSeeder extends Seeder
{
     use SeedOnce;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::create([
            'id' => '00000000-0000-0000-0000-000000000001',
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'phone' => '1234567890',
            'password' => '12345678',
        ]);

    }
}

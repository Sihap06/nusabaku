<?php

use Illuminate\Database\Seeder;
use App\Traits\HasCompositePrimaryKey;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();

        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'master_admin']);
        // Role::create(['name' => 'user']);

        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        $user = new Role();
        $user->name = 'user';
        $user->save();
    }
}

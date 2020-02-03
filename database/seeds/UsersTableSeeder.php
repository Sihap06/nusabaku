<?php

use Illuminate\Database\Seeder;
use App\Traits\HasCompositePrimaryKey;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        // DB::table('role_user')->truncate();


        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $user = new User();
        $user->name = 'sihap';
        $user->email = 'baharuddinsihap@gmail.com';
        $user->password = bcrypt('sihap');
        $user->save();
        $user->roles()->attach($adminRole);

        // factory(App\User::class, 50)->create();


        
    }
}

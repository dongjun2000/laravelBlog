<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)->create();
        $user = \App\User::find(1);
        $user->name = '董俊';
        $user->email = '418826102@qq.com';
        $user->password = bcrypt('admin');
        $user->save();
    }
}

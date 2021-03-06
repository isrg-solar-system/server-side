<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //	id	name	email	password	remember_token	created_at	updated_at
        $user = new \App\User();
        $user->name = 'img21326';
        $user->email = 'img21326@gmail.com';
        $user->level = '1';
        $user->password =  Hash::make('password');
        $user->save();

        $user = new \App\User();
        $user->name = 'qwe21326';
        $user->email = 'qwe21326@gmail.com';
        $user->level = '0';
        $user->password =  Hash::make('password');
        $user->save();

        $user = new \App\User();
        $user->name = 'test';
        $user->email = 'test@gmail.com';
        $user->level = '0';
        $user->password =  Hash::make('password');
        $user->save();
    }
}

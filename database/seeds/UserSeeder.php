<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' 		 => 'Maycol Sanchez',
            'username'   => 'maycoldsm1234',
            'email'      => 'maycoldsm1234@gmail.com',
            'password'   =>  Hash::make('891012VaJu')
        ]);

        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
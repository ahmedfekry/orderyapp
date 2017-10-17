<?php

use Illuminate\Database\Seeder;
use App\User;
  
class UserTableSeeder extends Seeder {
  
    public function run() {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123456),
        ]);
    }
}
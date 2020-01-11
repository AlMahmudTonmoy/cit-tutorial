<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'Admin',
          'email' => 'admin'.'@admin.com',
          'password' => bcrypt('Cr1234567'),
          'email_verified_at' => Carbon::now(),
          'role' => 1,
          'created_at' => Carbon::now(),
      ]);
    }
}

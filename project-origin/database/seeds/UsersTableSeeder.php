<?php

use Illuminate\Database\Seeder;

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
        'name' => 'Jordan Formanek',
        'email' => 'jordanformanek@gmail.com',
        'password' => bcrypt('password')
      ]);

      DB::table('users')->insert([
        'name' => 'Test User',
        'email' => 'test@gmail.com',
        'stripe_id' => 'cus_00000000000000 ',
        'password' => bcrypt('password')
      ]);
    }
}

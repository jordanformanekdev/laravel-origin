<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('plans')->insert([
        'name' => 'Basic Subscription',
        'plan_id' => 'plan_EsjevCafH8sfGI',
        'price' => 1000
      ]);

      DB::table('plans')->insert([
        'name' => 'Premium Subscription',
        'plan_id' => 'plan_Esjgxj3CzqhLX1',
        'price' => 2000
      ]);
    }
}

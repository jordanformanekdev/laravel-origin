<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')->insert([
        'name' => 'Basic Product',
        'description' => 'Basic Product Description',
        'price' => 1000
      ]);

      DB::table('products')->insert([
        'name' => 'Premium Product',
        'description' => 'Premium Product description',
        'price' => 2000
      ]);
    }
}

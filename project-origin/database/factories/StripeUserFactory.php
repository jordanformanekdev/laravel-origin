<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\StripeUser;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\StripeUser::class, function (Faker $faker) {
    return [
      'stripe_active' => 0,
      'stripe_id' => 'fake_user_id',
      'user_id' => 1,
      
        // 'subscription_end_at' => now(), // secret
        // 'remember_token' => Str::random(10),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;


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

$factory->define(User::class,  function (Faker $faker) {

    return [
        'name' => $faker->name,
        'cpf_cnpj' => '24.925.701/0001-08',
        'email' => $faker->unique()->safeEmail,
        'is_active' => 1,
        'password' => bcrypt(123456),
        'email_verified_at' => now(),
        'user_type_id' => 2
    ];
});

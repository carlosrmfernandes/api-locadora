<?php

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;
use Faker\Generator as Faker;

class UserForTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $user = [
            'name' => $faker->name,
            'cpf_cnpj' => '14.899.427/0001-88',
            'email' => "adm@gmail.com",
            'is_active' => 1,
            'password' => bcrypt(123456),
            'email_verified_at' => now(),
            'user_type_id' => 1
        ];

        User::create($user);
    }
}

<?php

namespace Tests\Unit\Services;

use App\Service\V1\User\UserServiceRegistration;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \App\Service\V1\User\Traits\RuleTrait;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $attributes = [
            'name' => "test",
            'cpf_cnpj' => '24.925.701/0001-08',
            'email' => "test@gmail.com",
            'is_active' => 1,
            'password' => "123456",
            'passwdSame' => "123456",
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'user_type_id' => 2,

        ];


        $UserRepository = new UserRepository(new User());
        $userTypeRepository = new UserTypeRepository(new UserType());

        $userServiceRegistration = new UserServiceRegistration(
                $UserRepository,
                $userTypeRepository
        );
        $user = $userServiceRegistration->store($attributes);
        $this->assertEquals($user, "Successful registration, check your email please, wait for admin approval");
    }

}

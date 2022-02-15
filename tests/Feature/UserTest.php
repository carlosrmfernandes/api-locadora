<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use \Illuminate\Foundation\Testing\DatabaseTransactions;
    public function testBasicTest()
    {
        $response = $this->json('POST',
             '/api/user',
            [
                'name' => "test",
                'cpf_cnpj' => '24.925.701/0001-08',
                'email' => "test@gmail.com",
                'is_active' => 1,
                'password' => "123456",
                'passwdSame' => "123456",
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'user_type_id' => 2,
        ],["Content-Type"=>"application/json"]);

        $response->assertStatus(200);
    }
}

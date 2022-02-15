<?php

namespace Tests\Unit\Register;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {

        $user = factory(User::class)->create();

        $expcetedUserId = User::find($user->id);
        $this->assertEquals($expcetedUserId->id, $user->id);
        $this->login($user);
    }

    function login($user) {
        $this->be($user);
        $expceted = User::find($user->id);
        $this->assertEquals($expceted->id, $user->id);

    }

}

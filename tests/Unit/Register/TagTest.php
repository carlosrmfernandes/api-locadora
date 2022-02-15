<?php

namespace Tests\Unit\Register;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $tag = factory(Tag::class)->create();
        $expcetedTagId = Tag::find($tag->id);
        $this->assertEquals($expcetedTagId->id, $tag->id);
    }



}

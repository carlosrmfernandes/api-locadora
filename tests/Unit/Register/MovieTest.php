<?php

namespace Tests\Unit\Register;

use App\Models\Movie;
use Tests\TestCase;

class MovieTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $movie = factory(Movie::class)->create();
        $expcetedMovieId = Movie::find($movie->id);
        $this->assertEquals($expcetedMovieId->id, $movie->id);
    }



}

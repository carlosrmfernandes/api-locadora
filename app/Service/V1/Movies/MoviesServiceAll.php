<?php

namespace App\Service\V1\Movies;

use App\Repository\V1\Movies\MovieRepository;

class MoviesServiceAll
{
    protected $movieRepository;

    public function __construct(
        MovieRepository $movieRepository
    )
    {
        $this->movieRepository = $movieRepository;
    }

    public function all($searchQuery = null)
    {
        return $this->movieRepository->all($searchQuery);
    }

}

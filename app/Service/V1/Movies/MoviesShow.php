<?php

namespace App\Service\V1\Movies;

use App\Repository\V1\Movies\MovieRepository;

class MoviesShow {

    protected $movieRepository;

    public function __construct(
    MovieRepository $movieRepository
    ) {
        $this->movieRepository = $movieRepository;
    }

    public function show(int $id) {
        return $this->movieRepository->show($id);
    }

}

<?php

namespace App\Service\V1\Movies;

use App\Repository\V1\Movies\MovieRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Validator;

class MoviesDelete {

    use Traits\RuleTrait;

    protected $movieRepository;

    public function __construct(
        MovieRepository $movieRepository
    ) {
        $this->movieRepository = $movieRepository;
    }

    public function delete(int $id) {

        if (!get_object_vars(($this->movieRepository->show($id)))) {
            return "movie not found";
        }

        $movie = $this->movieRepository->delete($id);

        return $movie ?? "movie invalid";
    }

}

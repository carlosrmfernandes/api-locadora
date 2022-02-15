<?php

namespace App\Service\V1\MovieTag;

use App\Repository\V1\MovieTag\MovieTagRepository;
use App\Repository\V1\Tag\TagRepository;
use App\Repository\V1\Movies\MovieRepository;

use Validator;

class MovieTagRegistration {

     use Traits\RuleTrait;

    protected $movieTagRepository;
    protected $movieRepository;
    protected $tagRepository;

    public function __construct(
        MovieTagRepository $movieTagRepository,
        MovieRepository $movieRepository,
        TagRepository $tagRepository
    ) {
        $this->movieTagRepository = $movieTagRepository;
        $this->movieRepository = $movieRepository;
        $this->tagRepository = $tagRepository;

    }

    public function store($request) {

        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $validator = Validator::make($attributes, $this->rules());
        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->movieRepository->show($attributes['movie_id'])))) {
            return "movie not found";
        }

        if (!get_object_vars(($this->tagRepository->show($attributes['tag_id'])))) {
            return "tag not found";
        }

        $movieTagRepository = $this->movieTagRepository->save($attributes);

        return $movieTagRepository ?? "unidentified tag";

    }

}


<?php

namespace App\Service\V1\MovieTag;

use App\Repository\V1\MovieTag\MovieTagRepository;
use App\Repository\V1\Tag\TagRepository;
use App\Repository\V1\Movies\MovieRepository;
use Illuminate\Http\Request;

use Validator;

class MovieTagUpdate {

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

    public function update(int $id, Request $request) {
        $attributes = $request->all();

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

        $tag = $this->movieTagRepository->update($id, $attributes);

        return $tag ?? "movie tag invalid";
    }

}

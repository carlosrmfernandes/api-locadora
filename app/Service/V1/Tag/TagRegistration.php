<?php

namespace App\Service\V1\Tag;

use App\Repository\V1\Tag\TagRepository;

use Validator;

class TagRegistration {

     use Traits\RuleTrait;

    protected $movieRepository;

    public function __construct(
        TagRepository $tagRepository
    ) {
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

        $tag = $this->tagRepository->save($attributes);

        return $tag ?? "unidentified tag";

    }

}

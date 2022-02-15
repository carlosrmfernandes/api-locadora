<?php

namespace App\Service\V1\Tag;

use App\Repository\V1\Tag\TagRepository;
use Illuminate\Http\Request;

use Validator;

class TagUpdate {

    use Traits\RuleTrait;

    protected $tagRepository;

    public function __construct(
        TagRepository $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    public function update(int $id, Request $request) {
        $attributes = $request->all();

        $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->tagRepository->show($id)))) {
            return "tag not found";
        }

        $tag = $this->tagRepository->update($id, $attributes);

        return $tag ?? "movie invalid";
    }

}

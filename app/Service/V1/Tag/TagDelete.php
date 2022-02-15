<?php

namespace App\Service\V1\Tag;

use App\Repository\V1\Tag\TagRepository;

class TagDelete
{

    protected $movieRepository;

    public function __construct(
        TagRepository $tagRepository
    )
    {
        $this->tagRepository = $tagRepository;
    }

    public function delete(int $id)
    {
        if (!get_object_vars(($this->tagRepository->show($id)))) {
            return "tag not found";
        }
        return $this->tagRepository->delete($id);
    }


}

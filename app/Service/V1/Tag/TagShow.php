<?php

namespace App\Service\V1\Tag;

use App\Repository\V1\Tag\TagRepository;

class TagShow
{

    protected $movieRepository;

    public function __construct(
        TagRepository $tagRepository
    )
    {
        $this->tagRepository = $tagRepository;
    }

    public function show(int $id)
    {
        return $this->tagRepository->show($id);
    }


}

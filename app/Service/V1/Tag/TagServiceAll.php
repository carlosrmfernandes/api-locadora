<?php

namespace App\Service\V1\Tag;

use App\Repository\V1\Tag\TagRepository;

class TagServiceAll
{
    protected $movieRepository;

    public function __construct(
        TagRepository $tagRepository
    )
    {
        $this->tagRepository = $tagRepository;
    }

    public function all($searchQuery = null)
    {
        return $this->tagRepository->all($searchQuery);
    }

}

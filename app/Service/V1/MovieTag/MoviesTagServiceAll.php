<?php

namespace App\Service\V1\MovieTag;

use App\Repository\V1\Tag\TagRepository;

class MoviesTagServiceAll
{
    protected $movieTagRepository;

    public function __construct(
        TagRepository $tagRepository
    )
    {
        $this->tagRepository = $tagRepository;
    }

    public function tagWithMovie($searchQuery = null)
    {
        return $this->tagRepository->tagWithMovie($searchQuery);
    }

}

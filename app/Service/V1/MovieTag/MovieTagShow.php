<?php

namespace App\Service\V1\MovieTag;

use App\Repository\V1\MovieTag\MovieTagRepository;

class MovieTagShow
{

    protected $movieTagRepository;

    public function __construct(
        MovieTagRepository $movieTagRepository
    )
    {
        $this->movieTagRepository = $movieTagRepository;
    }

    public function show(int $id)
    {
        return $this->movieTagRepository->show($id);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovieFilters
 *
 * @author carlosfernandes
 */

namespace App\Filters\V1\MovieTag;

use App\Service\V1\MovieTag\MoviesTagServiceAll;

class MovieTagFilters
{

    private $searchQuery;
    private $moviesServiceAll;

    public function __construct(
        MoviesTagServiceAll $moviesTagServiceAll
    )
    {
        $this->moviesTagServiceAll = $moviesTagServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }

        return $this->moviesTagServiceAll->tagWithMovie($this->searchQuery);
    }

}

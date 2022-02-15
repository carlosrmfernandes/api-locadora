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

namespace App\Filters\V1\Movies;

use App\Service\V1\Movies\MoviesServiceAll;

class MoviesFilters
{

    private $searchQuery;
    private $moviesServiceAll;

    public function __construct(
        MoviesServiceAll $moviesServiceAll
    )
    {
        $this->moviesServiceAll = $moviesServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }

        return $this->moviesServiceAll->all($this->searchQuery);
    }

}

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

namespace App\Filters\V1\Tag;

use App\Service\V1\Tag\TagServiceAll;

class TagFilters
{

    private $searchQuery;
    private $tagServiceAll;

    public function __construct(
        TagServiceAll $tagServiceAll
    )
    {
        $this->tagServiceAll = $tagServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }

        return $this->tagServiceAll->all($this->searchQuery);
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleTrait
 *
 * @author carlosfernandes
 */

namespace App\Service\V1\MovieTag\Traits;
trait RuleTrait
{

    public function rules($id = null)
    {
        return [
            'movie_id' => 'required|integer',
            'tag_id' => 'required|integer'
        ];
    }

}

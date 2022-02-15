<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieTag extends Model
{
    protected $fillable = [
        'movie_id','tag_id'
    ];
    protected $visible = [
        'id','movie_id','tag_id'
    ];

}

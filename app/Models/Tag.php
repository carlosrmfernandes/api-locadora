<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name'
    ];
    protected $visible = [
        'id','name','movies'
    ];

    public function movies(){
        return $this->belongsToMany(Movie::class, 'movie_tags')
             ->withTimestamps();;
    }
}

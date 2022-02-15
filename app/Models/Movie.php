<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable = [
        'name', 'archive','size','user_id'
    ];
    protected $visible = [
        'id', 'name', 'archive','size','created_at','user_id'
    ];

}

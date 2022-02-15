<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'type','notifiable_type','notifiable_id','data','read_at','created_at','updated_at'
    ];
    protected $visible = [
        'id','type','notifiable_type','notifiable_id','data','read_at','created_at','updated_at'
    ];

}

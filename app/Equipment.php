<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    protected $fillable = [
        'name',
        'ome',
        'status'
    ];
}

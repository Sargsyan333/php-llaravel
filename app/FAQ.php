<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $fillable = [
        'name', 'text'
    ];
}

<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'text',
    ];
}

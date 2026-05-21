<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=['name','type','menu'];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'menu' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'header_section', 'blocks', 'status'];

    protected $casts = [
        'blocks' => 'array',
        'header_section' => 'array',
    ];
}

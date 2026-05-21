<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'title',
        'img',
        'img_desc',
        'slider',
        'meta_title',
        'slug',
        'summary',
        'meta_desc',
        'tags',
        'description',
        'page_views',
        'status',
        'is_draft',
        'published_at'
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array',
        'slider' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

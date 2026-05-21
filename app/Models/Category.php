<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id', 'title', 'slug', 'img', 'meta_title', 'meta_desc', 'status'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}

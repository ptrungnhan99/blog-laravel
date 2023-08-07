<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'parent_id', 'thumbnail'];

    // Relationship to get the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relationship to get the child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}

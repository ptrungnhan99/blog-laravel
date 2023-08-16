<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'content',
        'thumbnail',
        'view_counts',
        'user_id',
        'category_id',
        'slug',
        'approved',
        'highlight'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function next()
    {
        // get next post
        return Post::where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }
    public function previous()
    {
        // get previous post
        return Post::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
}

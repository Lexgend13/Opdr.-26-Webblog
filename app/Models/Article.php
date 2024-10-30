<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Article extends Model
{
    use HasFactory;
    protected $articles = 'articles';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}

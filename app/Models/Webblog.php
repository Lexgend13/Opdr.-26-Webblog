<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;


class Webblog extends Model
{
    protected $table = 'articles';
    use HasFactory;

    protected $articles = 'articles';
    protected $id = 'id';

    #unsafe version
    protected $guarded = [];

    protected function slugTitle(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::slug($value),
        );
    }
}

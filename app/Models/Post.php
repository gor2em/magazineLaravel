<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category()
    {
        //one to one = hasOne
        //one to many = hasMany
        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}

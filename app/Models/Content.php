<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ratings()
    {
        return $this->hasMany(Ranking::class, 'content_id', 'id')->get('rating');
    }

    public function category()
    {
        $category = $this->hasOne(Category::class, 'id', 'category_id')->get('name');
        $categoryName = $category[0]['name'];
        return $categoryName;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    public function content()
    {
        $content = $this->hasMany(Content::class, 'id', 'content_id')->get();
        return $content[0];
    }
}

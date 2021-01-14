<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'is_published', 'category_id', 'short_text', 'full_text', 'user_id'
    ];

    /**
     * Get category of
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get author
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

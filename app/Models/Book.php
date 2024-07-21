<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'author_id',
        'publisher',
        'isbn',
        'published_year',
        'cover',
        'file',
        'price',
        'discount_price',
        'total_pages',
        'total_views',
        'total_shares',
        'total_purchased',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Mentor::class, 'author_id', 'id');
    }
}

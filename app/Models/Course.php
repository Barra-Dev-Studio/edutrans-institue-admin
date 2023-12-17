<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'discount_price',
        'category_id',
        'mentor_id',
        'thumbnail',
        'note',
        'total_views',
        'total_shares',
        'total_students',
        'total_duration',
        'total_ratings',
        'is_certified',
        'status',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute()
    {
        $ratings = $this->ratings;

        if ($ratings->count() > 0) {
            $averageRating = $ratings->avg('rate');
            return number_format($averageRating, 1);
        }

        return 0; // Return 0 if there are no ratings
    }
}

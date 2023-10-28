<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentor extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $fillable = [
        'photo',
        'name',
        'speciality',
        'bio'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

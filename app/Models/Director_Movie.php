<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director_Movie extends Model
{
    use HasFactory;
    protected $table = 'director_movie';
    protected $fillable = [
        'director_id',
        'movie_id'
    ];
}
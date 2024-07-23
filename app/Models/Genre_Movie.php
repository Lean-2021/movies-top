<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_Movie extends Model
{
    use HasFactory;

    protected $table='genre_movie';
    protected $fillable = [
      'genre_id',
      'movie_id'
    ];
}
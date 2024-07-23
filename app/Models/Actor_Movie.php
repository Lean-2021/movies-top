<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor_Movie extends Model
{
    use HasFactory;
    protected $table = 'actor_movie';
    protected $fillable = [
      'actor_id',
      'movie_id'
    ];
}
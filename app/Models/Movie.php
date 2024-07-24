<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'movies';
  protected $fillable = [
    'title',
    'description',
    'language_id',
    'duration',
    'year',
    'votes',
    'section',
    'image',
    'image_url',
    'image_url_id',
    'cinema_id',
    'country_id',
    'order',
    'status',
  ];
}

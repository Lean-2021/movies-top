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

  // númer de orden autoincremental
  public static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      $model->order = Movie::max('order') + 1;
    });
  }

  // relación tabla lenguajes
  public function language()
  {
    return $this->belongsTo(Language::class, 'languages', 'id');
  }

  // relación tabla estudios
  public function cinema()
  {
    return $this->belongsTo(Cinema::class, 'cinemas', 'id');
  }

  // relación tabla paises
  public function country()
  {
    return $this->belongsTo(Country::class, 'countries', 'id');
  }

  // relación tabla generos
  public function genres()
  {
    return $this->belongsToMany(Genre::class, 'genre_movie');
  }
}

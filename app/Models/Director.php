<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Director extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'directors';
  protected $fillable = [
    'first_name',
    'last_name',
    'country_id',
    'status',
    'order'
  ];

  // incrementar el valor de order al crear un nuevo registro
  public static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      $model->order = Director::max('order') + 1;
    });
  }

  // Relación con la tabla paises
  public function country()
  {
    return $this->belongsTo(Country::class, 'country_id', 'id');
  }

  // relación tabla movies
  public function movies()
  {
    return $this->belongsToMany(Movie::class, 'director_movie');
  }

  // Obtener el nombre y apellido combinados
  public function getFullNameAttribute()
  {
    return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
  }
}
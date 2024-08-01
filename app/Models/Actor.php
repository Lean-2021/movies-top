<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'actors';
  protected $fillable = [
    'first_name',
    'last_name',
    'country_id',
    'order',
    'status',
  ];

  // incrementar el valor de order al crear un nuevo registro
  public static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      $model->order = Actor::max('order') + 1;
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
    return $this->belongsToMany(Movie::class, 'actor_movie');
  }

  // Obtener el nombre y apellido combinados
  public function getFullNameAttribute()
  {
    return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
  }
}
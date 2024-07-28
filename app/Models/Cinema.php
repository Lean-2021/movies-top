<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cinema extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'cinemas';
  protected $fillable = [
    'name',
    'country_id',
    'order',
    'status'
  ];

  // Actualizar el número de orden automáticamente
  public static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      $model->order = Cinema::max('order') + 1;
    });
  }

  //relación country
  public function country()
  {
    return $this->belongsTo(Country::class, 'country_id', 'id');
  }

  public function movies()
  {
    return $this->hasMany(Movie::class, 'movies', 'id');
  }
}

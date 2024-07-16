<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'genres';
  protected $fillable = [
    'name',
    'order',
    'status'
  ];

  public static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      $model->order = Genre::max('order') + 1;
    });
  }
}

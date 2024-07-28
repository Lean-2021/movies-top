<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'languages';
  protected $fillable = [
    'name',
    'flag',
  ];

  public function movies()
  {
    return $this->hasMany(Movie::class, 'movies', 'id');
  }
}

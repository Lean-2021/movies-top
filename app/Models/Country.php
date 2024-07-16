<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\SoftDeletes;

  class Country extends Model
  {
    use HasFactory;
    use SoftDeletes;

    protected $table = "countries";
    protected $fillable = [
      'name',
      'flag'
    ];

    // realción tabla directores
    public function directors()
    {
      return $this->hasMany(Director::class, 'country_id', 'id');
    }

    // relación tabla actores
    public function actors()
    {
      return $this->hasMany(Actor::class, 'country_id', 'id');
    }

    // Relación tabla cinemas
    public function cinemas()
    {
      return $this->hasMany(Cinema::class, 'country_id', 'id');
    }
  }

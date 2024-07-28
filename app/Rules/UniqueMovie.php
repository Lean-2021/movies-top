<?php

namespace App\Rules;

use App\Models\Movie;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueMovie implements ValidationRule
{
  protected
    $title,
    $description,
    $language_id,
    $duration,
    $year,
    $section,
    $image,
    $cinema_id,
    $country_id,
    $genres;

  public function __construct(array $movies)
  {
    $this->title = $movies["title"];
    $this->description = $movies["description"];
    $this->language_id = $movies["language_id"];
    $this->duration = $movies["duration"];
    $this->year = $movies["year"];
    $this->section = $movies["section"];
    $this->cinema_id = $movies["cinema_id"];
    $this->country_id = $movies["country_id"];
  }
  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $exists = Movie::where('title', $this->title)
      ->where('description', $this->description)
      ->where('language_id', $this->language_id)
      ->where('duration', $this->duration)
      ->where('year', $this->year)
      ->where('section', $this->section)
      ->where('cinema_id', $this->cinema_id)
      ->where('country_id', $this->country_id)
      ->exists();

    if ($exists) {
      $fail('Ya existe una película con los mismos datos');
    }
  }
}

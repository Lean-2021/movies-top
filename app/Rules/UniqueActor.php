<?php

  namespace App\Rules;

  use App\Models\Actor;
  use Closure;
  use Illuminate\Contracts\Validation\ValidationRule;

  class UniqueActor implements ValidationRule
  {
    protected $first_name, $last_name, $country_id;

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function __construct(string $first_name, string $last_name, string $country_id)
    {
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->country_id = $country_id;
    }

    // Comprobar si existe un actor exactamente igual
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
      $exists = Actor::query()
        ->where('first_name', $this->first_name)
        ->where('last_name', $this->last_name)
        ->where('country_id', $this->country_id)
        ->exists();

      if ($exists) {
        $fail("Ya existe un actor con los mismos datos");
      }
    }
  }

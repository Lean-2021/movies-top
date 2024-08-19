<?php

namespace App\Actions\Fortify;

use App\Mail\CreateUserSend;
use App\Mail\UserCreateReceived;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
  use PasswordValidationRules;

  /**
   * Validate and create a newly registered user.
   *
   * @param  array<string, string>  $input
   */
  public function create(array $input): User
  {
    Validator::make($input, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => $this->passwordRules(),
      'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    // Enviar correo al nuevo usuario registrado
    Mail::send(new CreateUserSend($input['name'], $input['email']));
    // Enviar correo de los nuevos usuarios regitrados
    Mail::send(new UserCreateReceived($input['name'], $input['email']));

    return User::create(
      [
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
      ]
    );
  }
}

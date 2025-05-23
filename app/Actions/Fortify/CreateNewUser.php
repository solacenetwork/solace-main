<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'account_type' => ['required', 'string', 'in:individual,business'], // Adjust as needed
            'terms' => ['required', 'boolean'],
        ])->validate();

        // Split name into first_name and last_name
        $names = explode(' ', trim($input['name']), 2);
        $first_name = $names[0];
        $last_name = $names[1] ?? '';

        return User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'account_type' => $input['account_type'],
            'terms' => $input['terms'],
            'newsletter' => $input['newsletter'] ?? false,
            'is_minor' => $input['is_minor'] ?? false,
            'phone' => $input['phone'] ?? null,
            'dob' => $input['dob'] ?? null,
            'nickname' => $input['nickname'] ?? null,
            'avatar' => $input['avatar'] ?? null,
        ]);
    }
}
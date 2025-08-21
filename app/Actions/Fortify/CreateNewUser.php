<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Enums\Role;

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
            // Normalize
            $data = $input;
            if (isset($input['year']) && !isset($input['year_level'])) {
                $data['year_level'] = $input['year'];
            }

            Validator::make($data, [
                'fullname' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
                'role' => ['required', 'string', Rule::in([Role::ADMIN->value, Role::STUDENT->value])],
                'course' => ['required', 'string', 'max:255'],
                'year_level' => ['required', 'integer', 'min:1'],
                'college' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string', Rule::in(['male', 'female', 'other'])],
            ])->validate();

            return User::create([
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role'=> $data['role'],
                'course' => $data['course'],
                'year_level' => $data['year_level'],
                'college' => $data['college'],
                'gender' => $data['gender'],
                'submission_count' => 0,
            ]);
    }
}

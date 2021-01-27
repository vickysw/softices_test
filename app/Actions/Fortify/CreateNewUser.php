<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\Phone_number;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number.*' => 'unique:table_phone_number,phone_number',
            'password' => $this->passwordRules(),
        ])->validate();
            // dd($input['phone_number']);
      
        
        // unset($input['phone_number']);
        // dd($input);

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['first_name'].' '.$input['last_name'],
                'first_name' =>$input['first_name'],
                'last_name' =>$input['last_name'],
                'gender' =>$input['gender'],
                'date_of_birth' => $input['date_of_birth'],
                'role' => $input['role'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use( $input ) {
                $this->phone_number($user,$input);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function phone_number(User $user,$request)
    {
       
        $phone_number = $request['phone_number'];
        $data = [];
        foreach($phone_number as $k=>$phone)
        {
            $data[$k]['phone_number'] = $phone;
            $data[$k]['user_id'] = $user->id;
        }

        // dd($data);
        Phone_number::insert($data);
    }
}

<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

function register(Request $request)
{
    $rules = [
        'username' => 'unique|required|max:255',
        'email' => 'unique:users|email|required',
        'password' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'dob' => 'required',
        'id_card' => 'required',
        'phone_number' => 'required',
    ];

    $input = $request->only('name', 'email', 'password', 'first_name', 'last_name', 'dob', 'is_card', 'phone_number');
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'error' => $validator->messages()]);
    }
    $username = $request->username;
    $email = $request->email;
    $password = $request->password;
    $first_name = $request->first_name;
    $last_name = $request->last_name;
    $dob = $request->dob;
    $is_card = $request->is_card;
    $phone_number = $request->phone_number;


    $user = \App\Models\Account::create([
        'name' => $username,
        'email' => $email,
        'password' => Hash::make($password),
        'first_name' => $first_name,
        'last_name' => $lascd t_name,
        'dob' => $dob,
        'is_card' => $is_card,
        'phone_number' => $phone_number,
    ]);
}


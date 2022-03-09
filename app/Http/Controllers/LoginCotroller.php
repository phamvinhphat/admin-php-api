<?php

namespace App\Http\Controllers;




use Illuminate\Http\Request;

class LoginCotroller extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID' => 'required|string|ID',
            'password' => 'required|string|password',
            'remember_me' => 'boolean'
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
 
        $credentials = request(['ID', 'password']);
 
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized'
            ], 401);
        }      $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
 
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
 
        $token->save();
 
        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}

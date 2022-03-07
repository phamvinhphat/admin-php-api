<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }
    /**
     * Create Account
     * @OA\Post (
     *     path="/api/Account/register",
     *     tags={"Account"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                    @OA\Property(
     *                          property="username",
     *                          type="string"
     *                      ),
     *                     @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                     @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="first_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="last_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="dob",
     *                          type="date"
     *                      ),
     *                      @OA\Property(
     *                          property="is_card",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="phone_number",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "property":"phatbeo",
     *                     "email":"fakeemail@gmail.com"
     *                     "password": "phatbeo"
     *                     "first_name": "phat"
     *                     "last_name": "beo"
     *                     "dob": "dob"
     *                     "is_card": "0722000003962"
     *                     "phone_number": "phatbeo"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */

    function register(Request $request)
    {
        $request->validate([
            'username' => 'unique|required|max:255',
            'email' => 'unique:users|email|required',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'id_card' => 'required',
            'phone_number' => 'required',
        ]);

        $account = new Account([
           'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'id_card' => $request->id_cart,
            'phone_number' => $request->phone_number,
        ]);

        $account->save();
        return response()->json(['message'=>'User has been register'],200);


//        $input = $request->only('name', 'email', 'password', 'first_name', 'last_name', 'dob', 'is_card', 'phone_number');
//        $validator = Validator::make($input, $rules);
//
//        if ($validator->fails()) {
//            return response()->json(['success' => false, 'error' => $validator->messages()]);
//        }
//        $username = $request->username;
//        $email = $request->email;
//        $password = $request->password;
//        $first_name = $request->first_name;
//        $last_name = $request->last_name;
//        $dob = $request->dob;
//        $is_card = $request->is_card;
//        $phone_number = $request->phone_number;
//
//
//        $user = \App\Models\Account::create([
//            'name' => $username,
//            'email' => $email,
//            'password' => Hash::make($password),
//            'first_name' => $first_name,
//            'last_name' => $last_name,
//            'dob' => $dob,
//            'is_card' => $is_card,
//            'phone_number' => $phone_number,
//        ]);
    }
}

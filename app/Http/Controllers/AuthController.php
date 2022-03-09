<?php

namespace App\Http\Controllers;
use App\Models\Account;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $successStatus = 200;
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }
    /**
     * Create Account
     * @OA\Post (
     *     path="/register",
     *     tags={"Account"},
     *     @OA\RequestBody(
     *     required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="username",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
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
     *                          property="id_card",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="avatar",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="gender",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="phone_number",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="privilege_id",
     *                          type="uuid"
     *                      ),
     *                 ),
     *                 example={
     *                     "username":"fake username",
     *                     "password":"fake password",
     *                     "first_name":"phat",
     *                     "last_name":"beo",
     *                     "dob":"2000-09-13",
     *                     "id_card":"0711113963",
     *                     "avatar":"https://cdn.pixabay.com/photo/2022/02/19/15/05/dark-7022879_960_720.jpg",
     *                     "gender":"Male",
     *                     "email":"fakeGmail@gmail.com",
     *                     "phone_number":"0999999999",
     *                     "privilege_id":"766be67a-6520-4968-85ea-e9e07daf4e53",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="uuid", example="766be67a-6520-4968-85ea-e9e07daf4e53"),
     *              @OA\Property(property="username", type="string", example="username"),
     *              @OA\Property(property="password", type="string", example="password"),
     *              @OA\Property(property="first_name", type="string", example="password"),
     *              @OA\Property(property="last_name", type="string", example="password"),
     *              @OA\Property(property="dob", type="date", example="2000-09-13"),
     *              @OA\Property(property="id_card", type="string", example="075555523658"),
     *              @OA\Property(property="avatar", type="string", example="avatar"),
     *              @OA\Property(property="gender", type="string", example="Male"),
     *              @OA\Property(property="email", type="string", example="fakeNew@gmail.com"),
     *              @OA\Property(property="phone_number", type="string", example="phone_number"),
     *              @OA\Property(property="privilege_id", type="uuid", example="privilege_id"),
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
    public function register(Request $request)
    {
        $account = $this->account->register($request->all());
        return response()->json($account);
    }


    /**
     * Get List account
     * @OA\Get (
     *     path="/api/account/getViewUser",
     *     tags={"Account"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="uuid",
     *                     ),
     *                     @OA\Property(
     *                         property="username",
     *                         type="string",
     *                         example="example username"
     *                     ),
     *                     @OA\Property(
     *                         property="first_name",
     *                         type="string",
     *                         example="example first_name"
     *                     ),
     *                     @OA\Property(
     *                         property="last_name",
     *                         type="string",
     *                         example="example last_name"
     *                     ),
     *                     @OA\Property(
     *                         property="gender",
     *                         type="string",
     *                         example="example gender"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="example email"
     *                     ),
     *                     @OA\Property(
     *                         property="phone_number",
     *                         type="string",
     *                         example="example phone_number"
     *                     ),
     *                     @OA\Property(
     *                         property="privilege_id",
     *                         type="uuid",
     *                         example="example privilege_id"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function getViewUser(){
        $users = $this->account->getsUser();
        return response()->json(["data"=>$users]);
    }
}

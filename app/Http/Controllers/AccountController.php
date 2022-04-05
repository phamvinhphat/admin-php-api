<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Repository\IUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AccountController extends Controller
{
    private IUserRepository $IUserRepository;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->IUserRepository = $IUserRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @return JsonResponse
     */
    public function getViewUser()
    {
        return response()->json([
            'data' => $this->IUserRepository->getAllUser()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateRoleById(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->get('role_id');
        return response()->json([
            $this->IUserRepository->updateRoleById($orderId, $orderDetails) => 'update role success'
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkRole(Request $request)
    {
        $orderId = $request->route('id');
        return response()->json([
            $this->IUserRepository->checkRole($orderId)
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeIsAdmin(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->get('is_admin');
        return response()->json([
            $this->IUserRepository->changeIsRole($orderId, $orderDetails) => 'change success'
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getUserById($id)
    {
        return response()->json([
            'data' => $this->IUserRepository->getUserById($id)
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateUser(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'username',
            'email',
            'first_name',
            'last_name',
            'dob',
            'is_card',
            'phone_number',
        ]);

        return response()->json([
            'data' => $this->IUserRepository->updateRoleById($orderId, $orderDetails)
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
            return response()->json([
                'data' => $this->IUserRepository->login($credentials)
            ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function register(Request $request)
    {
        $id = Uuid::uuid4()->toString();
        $email = $request->get('email');
        $password = Hash::make($request->get('password'));
        $username = $request->get('username');
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $idCard = $request->get('idCard');
        $phoneNumber = $request->get('phoneNumber');
        $currentDateTime = Carbon::now();

        $data = array (
            "id" => $id,
            "email" => $email,
            "password" => $password,
            "username" => $username,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "id_card" => $idCard,
            "phone_number" => $phoneNumber,
            "created_at" => $currentDateTime,
            "updated_at" => $currentDateTime,
        );

        return response()->json([
           'result' => $this->IUserRepository->signUp($data)
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        return response()->json([
            $this->IUserRepository->logout()
        ]);
    }

}

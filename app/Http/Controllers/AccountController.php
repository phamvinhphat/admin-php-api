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
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccountController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->userRepository = $IUserRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register','refresh']]);
    }

    public function getViewUser()
    {
        return $this->userRepository->getAllUser();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateRoleById(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->get('role_id');

        return $this->userRepository->updateRoleById($orderId, $orderDetails);
    }

    /**
     * find user by id
     * @param Request $request
     * @return JsonResponse
     */
    public function findUserById(Request $request)
    {
        $idUser = $request->route('id');
        return response()->json([
            "Result" => $this->userRepository->findUserById($idUser)
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkRole(Request $request)
    {
        $orderId = $request->route('id');
        return response()->json([
            "isAdmin: "=> $this->userRepository->checkRole($orderId)
        ],ResponseAlias::HTTP_ACCEPTED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeIsAdmin(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->get('is_admin');
        return $this->userRepository->changeIsRole($orderId, $orderDetails);
    }

    /**
     * @return JsonResponse
     */
    public function getMyInfo()
    {
        return  $this->userRepository->getMyInfo();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateUser(Request $request)
    {
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $idCard = $request->get('id_card');
        $phoneNumber = $request->get('phone_number');
        $dob = $request->get('dob');
        $gender = $request->get('gender');
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array (
            "first_name" => $firstName,
            "last_name" => $lastName,
            "id_card" => $idCard,
            "dob" => $dob,
            "gender" => $gender,
            "phone_number" => $phoneNumber,
            "updated_at" => $currentDateTime,
        );

        return $this->userRepository->updateUser($data);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        $email = $request->input('email');
        $password = $request->input('password');

        $account = DB::table('account')->where('email', '=', $email)->first();

        if (!$account || !Hash::check($password, $account->password)) {
            return response()->json(['message' => 'Login Fail, please check email and password'],
                ResponseAlias::HTTP_BAD_REQUEST);
        }

        return $this->userRepository->login($credentials);
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
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $idCard = $request->get('id_card');
        $phoneNumber = $request->get('phone_number');
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

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

        return  $this->userRepository->signUp($data);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        return $this->userRepository->logout();
    }

    /**
     * @return mixed
     */
    public function refresh()
    {
        return $this->userRepository->refresh();
    }

    public function changePassword()
    {

   //     return $this->userRepository->changePassword(Auth::id())
    }

}

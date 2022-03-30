<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\IUserRepository;
use PHPUnit\Util\Json;
class AccountController extends Controller
{
    private IUserRepository $IUserRepository;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->IUserRepository = $IUserRepository;
    }

    public function getViewUser()
    {
        return response()->json([
            'data' => $this->IUserRepository->getAllUser()
        ]);
    }

    public function updateRoleById(Request $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->get('role_id');
        return response()->json([
            $this->IUserRepository->updateRoleById($orderId, $orderDetails) => 'update role success'
        ],200);
    }

    public function checkRole(Request $request)
    {
        $orderId = $request->route('id');
        return response()->json([
            $this->IUserRepository->checkRole($orderId)
        ]);
    }

    public function changeIsAdmin(Request $request){
        $orderId = $request->route('id');
        $orderDetails = $request->get('is_admin');
        return response()->json([
            $this->IUserRepository->changeIsRole($orderId, $orderDetails) => 'change success'
        ],200);
    }

    public function getUserById($id)
    {
        return response()->json([
           'data' => $this->IUserRepository->getUserById($id)
        ]);
    }

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

}

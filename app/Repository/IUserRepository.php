<?php

namespace App\Repository;

use Illuminate\Http\JsonResponse;

interface IUserRepository
{
    public function register(array $orderDetails);
    public function getAllUser();
    public function getRoleByIdUser($id);
    public function getUserById($id);
    public function updateRoleById($userId,array $collection);
    public function updateUser($userId, array $newDetails);
}

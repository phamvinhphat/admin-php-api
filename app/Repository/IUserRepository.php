<?php

namespace App\Repository;


interface IUserRepository
{
    public function register(array $orderDetails);
    public function getAllUser();
    public function getRoleByIdUser($id);
    public function getUserById($id);
    public function updateRoleById($id,string $roleID);
    public function changeIsRole($id, bool $isAdmin);
    public function updateUser($userId, array $newDetails);
    public function checkRole($id);
}

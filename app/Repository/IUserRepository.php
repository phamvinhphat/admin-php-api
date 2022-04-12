<?php

namespace App\Repository;


interface IUserRepository
{
    public function login(array $infoUser);
    public function signUp(array $infUser);
    public function refresh();
    public function logout();
    public function findUserById($id);
    public function getAllUser();
    public function getRoleByIdUser($id);
    public function getMyInfo();
    public function updateRoleById($id, string $roleID);
    public function changeIsRole($id, bool $isAdmin);
    public function updateUser(array $newDetails);
    public function checkRole($id);
    public function changePassword($id, string $pass);
    public function changePassword($id, $pass);

}

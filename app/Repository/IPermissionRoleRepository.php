<?php

namespace App\Repository;

interface IPermissionRoleRepository
{
    public function createGrantPermission(array $data);
    public function getAllGrantPermission();
    public function finGrantPermissionByIdRole($idRole);
    public function isGrantPermissionById($idRole, $idPermission);
    public function updateGrantPermission($idRole, $idPermission, array $data);
    public function deleteGrantPermission($idRole, $idPermission);
}

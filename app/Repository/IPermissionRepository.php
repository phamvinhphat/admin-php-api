<?php

namespace App\Repository;

interface IPermissionRepository
{
    public function getAllPermission();
    public function findPermissionById($id);
    public function isPermissionById($id);
    public function findPermissionByName(string $name);
    public function createPermission(array $data);
    public function updatePermission($id, array $data);
    public function deletePermission($id);
}

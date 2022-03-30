<?php

namespace App\Repository;

interface IPermissionRepository
{
    public function getAllPermission();
    public function findPermissionById($id);
    public function isPermissionById($id);
    public function findPermissionByTitle(string $title);
    public function createPermission(array $data);
    public function updatePermission($id, string $Title);
    public function deletePermission($id);
}

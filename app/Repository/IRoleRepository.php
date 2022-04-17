<?php

namespace App\Repository;

interface IRoleRepository
{
    public function getAllRole();
    public function getMyRole($id);
    public function createRole($data);
    public function deleteRole($id);
    public function updateRole($id, $data);
    public function listAdmin();
    public function listUser();
    public function countListAdmin();
    public function countListUser();
}

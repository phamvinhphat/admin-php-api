<?php

namespace App\Repository;

interface IRoleRepository
{
    public function getAllRole();
    public function getMyRole($id);
    public function createRole($data);
    public function deleteRole($id);
    public function updateRole($id, $data);
}

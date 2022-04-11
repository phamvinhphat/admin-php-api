<?php

namespace App\Repository;

interface IRoleRepository
{
    public function getAllRole();
    public function getMyRole($id);
}

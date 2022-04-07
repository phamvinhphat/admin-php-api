<?php

namespace App\Repository;

interface IStatusRepository
{
    public function createStatus(array $data);
    public function findStatusById($id);
    public function getAllStatus($id);
}

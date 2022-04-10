<?php

namespace App\Repository;

interface IStatusRepository
{
    public function createStatus(array $data);
    public function findStatusById($id);
    public function getAllStatus();
    public function checkIdStatus($id);
    public function deleteStatusById($id);
    public function findStatusByMyId($id);
    public function updateStatusById($id, array $data);
}

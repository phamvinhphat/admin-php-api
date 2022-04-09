<?php

namespace App\Repository;

interface IWorkflowRepository
{
    public function createWorkflow(array $data);
    public function updateWorkflow($id, array $data);
    public function deleteWorkflow($id);
    public function getAllWorkflow();
    public function findWorkflowById($id);
}

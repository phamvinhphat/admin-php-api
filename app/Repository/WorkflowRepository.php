<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WorkflowRepository implements IWorkflowRepository
{

    public function createWorkflow(array $data)
    {
        $validator = Validator::make($data, [
            'status_id' => 'required|uuid|find:status',
            'document_id' => 'required|uuid|find:document'
        ]);
        if ($validator->fails()) {
            return response()->json(
                ["message" => $validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        return response()->json([
            "result" => DB::table('workflow')->insert($data)
        ], ResponseAlias::HTTP_CREATED);
    }

    public function updateWorkflow($id, array $data)
    {
        // TODO: Implement updateWorkflow() method.
    }

    public function deleteWorkflow($id)
    {
        // TODO: Implement deleteWorkflow() method.
    }

    public function getAllWorkflow()
    {
        // TODO: Implement getAllWorkflow() method.
    }

    public function findWorkflowById($id)
    {
        // TODO: Implement findWorkflowById() method.
    }
}

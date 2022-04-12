<?php

namespace App\Http\Controllers;

use App\Repository\IWorkflowRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class WorkflowController extends Controller
{
    private IWorkflowRepository $workflowRepository;

    public function __construct(IWorkflowRepository $iWorkflowRepository)
    {
        $this->workflowRepository = $iWorkflowRepository;
        $this->middleware('auth:api');
    }

    public function createdWorkflow(Request $request){

        $id = Uuid::uuid4()->toString();
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
        $idStatus = $request->get('status_id');
        $idDoc = $request->get('document_id');


        $data = array(
            'id' => $id,
            'status_id' => $idStatus,
            'document_id'=> $idDoc,
            'created_by_id' => Auth::id(),
            'modified_by_id' => Auth::id(),
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
        );
         return $this->workflowRepository->createWorkflow($data);
    }

    public function getAllWorkflow()
    {
        return $this->workflowRepository->getAllWorkflow();
    }

    public function deleteWorkflow( Request $request )
    {
        $id = $request->route('id');
        return $this->workflowRepository->deleteWorkflow($id);
    }

    public function updateWorkflow(Request $request)
    {
        $idStatus = $request->get('status_id');
        $idDoc = $request->get('document_id');
        $id = $request->route('id');
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array(
            'status_id' => $idStatus,
            'document_id'=> $idDoc,
            'modified_by_id' => Auth::id(),
            'updated_at' => $currentDateTime,
        );

        return $this->workflowRepository->updateWorkflow($id, $data);
    }

    public function findWorkflowById(Request $request)
    {
        $id = $request->route('id');
        return $this->workflowRepository->findWorkflowById($id);
    }

}

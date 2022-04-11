<?php

namespace App\Http\Controllers;

use App\Repository\IDocumentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\service\PermissionService;
use Ramsey\Uuid\Uuid;

class DocumentController extends Controller
{
    private IDocumentRepository $iDocumentRepository;
    private PermissionService $permissionService;


    public function __construct(IDocumentRepository $iDocumentRepository, PermissionService $permissionService)
    {
        $this->iDocumentRepository = $iDocumentRepository;
        $this->permissionService = $permissionService;
        $this->middleware('auth:api');
    }

    public function createDocument(Request $request){
        $id = Uuid::uuid4()->toString();
        $docCode = $request->get('document_code');
        $data = json_encode($request->get('data'));

        $DB = array(
            "id" => $id,
            "document_code" => $docCode,
            "data" => $data,
            "modified_by_id" => Auth::id(),
            "created_by_id" => Auth::id(),
            "created_at" => Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at" => Carbon::now('Asia/Ho_Chi_Minh'),
        );

        return $this->iDocumentRepository->createDocument($DB);
    }

    public function getAllDocument()
    {
        return $this->iDocumentRepository->getAllDocument();
    }

    public function findDocumentById(Request $request)
    {
        $id = $request->route('id');

        return $this->iDocumentRepository->findDocumentById($id);
    }

    public function deleteDocumentById(Request $request)
    {
        $id = $request->route('id');
        return $this->iDocumentRepository->deleteDocumentById($id);
    }

    public function findDocByIdUser(Request $request)
    {
        $id = $request->route('id');
        return $this->iDocumentRepository->findDocumentByIdUser($id);
    }

    public function findDocByMyId()
    {
        return $this->iDocumentRepository->findDocumentByIdUser(Auth::id());
    }

    public function updateDocByID(Request $request)
    {
        $id = $request->route('id');
        $docCode = $request->get('document_code');
        $data = json_encode($request->get('data'));

        $DB = array(
            'document_code' => $docCode,
            'data' =>  $data,
            'modified_by_id' => Auth::id(),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        );

        return $this->iDocumentRepository->updateDocumentById($id, $DB);
    }

    public function findStatusByIdDoc(Request $request)
    {
        $id = $request->route('id');

        return $this->iDocumentRepository->findStatusByIdDocument($id);
    }

    public function checkRole()
    {
        return $this->permissionService->checkPermission(Auth::id(), "document", "view");
    }

    public function getDocStatus()
    {
        return $this->iDocumentRepository->NotCheckAllDocument();
    }

    public function getDoneDocStatus()
    {
        return $this->iDocumentRepository->checkDoneAllDocument();
    }

    public function getPendingDocStatus()
    {
        return $this->iDocumentRepository->checkPendingAllDocument();
    }

}

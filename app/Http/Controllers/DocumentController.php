<?php

namespace App\Http\Controllers;

use App\Http\Resource\DocumentResource;
use App\Repository\IDocumentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\service\PermissionService;
use Ramsey\Uuid\Uuid;

class DocumentController extends Controller
{
    private IDocumentRepository $documentRepository;
    private PermissionService $permissionService;


    public function __construct(IDocumentRepository $iDocumentRepository, PermissionService $permissionService)
    {
        $this->documentRepository = $iDocumentRepository;
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

        return $this->documentRepository->createDocument($DB);
    }

    public function getAllDocument()
    {
        return $this->documentRepository->getAllDocument();
    }

    public function findDocumentById(Request $request)
    {
        $id = $request->route('id');

        return $this->documentRepository->findDocumentById($id);
    }

    public function deleteDocumentById(Request $request)
    {
        $id = $request->route('id');
        return $this->documentRepository->deleteDocumentById($id);
    }

    public function findDocByIdUser(Request $request)
    {
        $id = $request->route('id');
        return $this->documentRepository->findDocumentByIdUser($id);
    }

    public function findDocByMyId()
    {
        return $this->documentRepository->findDocumentByIdUser(Auth::id());
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

        return $this->documentRepository->updateDocumentById($id, $DB);
    }

    public function findStatusByIdDoc(Request $request)
    {
        $id = $request->route('id');

        return $this->documentRepository->findStatusByIdDocument($id);
    }

    public function checkRole()
    {
        return $this->permissionService->checkPermission(Auth::id(), "document", "view");
    }

//    public function getDocStatus()
//    {
//        return $this->iDocumentRepository->NotCheckAllDocument();
//    }

//    public function getDoneDocStatus()
//    {
//        return $this->iDocumentRepository->checkDoneAllDocument();
//    }

    public function getAllDocumentAndStatus()
    {
        $data = $this->documentRepository->getAllDocumentOfStatus();
        return response()->json(DocumentResource::collection($data));
    }

}

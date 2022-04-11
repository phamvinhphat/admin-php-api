<?php

namespace App\Repository;
use App\Repository\IDocumentRepository;
use App\service\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DocumentRepository implements IDocumentRepository
{

    private IUserRepository $iUserRepository;
    private PermissionService $permissionService;

    public function __construct(IUserRepository $iUserRepository, PermissionService $permissionService)
    {
        $this->iUserRepository = $iUserRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function createDocument($data)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","create");
        if($isAdmin == true || $isRole == true) {
            $validator = Validator::make($data, [
                'document_code' => 'required',
                'data' => 'required|json',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ["message" => $validator->errors()],
                    ResponseAlias::HTTP_UNAUTHORIZED
                );
            }

            return response()->json([
                "result" => DB::table('document')
                    ->insert($data)
            ], ResponseAlias::HTTP_CREATED);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findDocumentById($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","find");
        if($isAdmin == true || $isRole == true) {
           $doc = DB::table('document')->where('id', $id)->first();
           if(!is_null($doc))
           {
               return response()->json([
                   "result" => $doc
               ], ResponseAlias::HTTP_OK);
           } else {
               return response()->json(['message', 'Not Found'],ResponseAlias::HTTP_BAD_REQUEST);
       }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteDocumentById($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","delete");
        if($isAdmin == true || $isRole == true) {
            if ($this->checkIdDocument($id) == true) {
                return response()->json([
                    "result" => DB::table('document')->delete($id)
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                    "error" => "Not Found"
                ], ResponseAlias::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @param array $data
     * @return JsonResponse
     */
    public function updateDocumentById($id, array $data)
    {

        $validator = Validator::make($data, [
            'document_code' => 'required',
            'data' =>  'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ["message"=>$validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","update");
        if($isAdmin == true || $isRole == true) {
            if($this->checkIdDocument($id) == true)
            {
                return response()->json([
                   "result" => DB::table('document')
                       ->where('id', $id)
                       ->update($data)
                ],ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                    "error" => "Not Found"
                ], ResponseAlias::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findDocumentByIdUser($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","findById");
        if($isAdmin == true || $isRole == true) {
            if ($this->iUserRepository->findUserById($id) == true) {
                return response()->json([
                    "result" => DB::table('document')
                        ->where('created_by_id', $id)
                        ->get()
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                    "error" => "Not Found"
                ]);
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkIdDocument($id)
    {
        $isCheckId = DB::table('document')->find($id);
        if(!is_null($isCheckId))
        {
            return true;
        } else {
            return false;
        }
    }

    public function getAllDocument()
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","view");
        if($isAdmin == true || $isRole == true) {
            return response()->json([
                "result" => DB::table('document')->get()
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function findStatusByIdDocument($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","findByDocument");
        if($isAdmin == true || $isRole == true)
        {
            $resultWorkflowById = DB::table('workflow')
                ->where('workflow.document_id', '=', $id)
                ->value('status_id');
            if (!is_null($resultWorkflowById)) {
                $resultStatusById = DB::table('status')
                    ->where('id', $resultWorkflowById)
                    ->get();
                if(!is_null($resultStatusById))
                {
                    return response()->json([
                        "result" => $resultStatusById
                    ], ResponseAlias::HTTP_OK );
                } else {
                    return response()->json(
                        ["message" => "Status Not Found"],
                        ResponseAlias::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json(
                    ["message" => "Workflow Not Found"],
                    ResponseAlias::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

//    public function NotCheckAllDocument()
//    {
//        $getPermissionById = DB::table('status')
//            ->select('id')
//            ->where('name','!=','Done')
//            ->where('name','!=','Pending')
//            ->pluck('status.id');
//
//        $getStatus =  DB::table('workflow')
//            ->whereIn('status_id', $getPermissionById)
//            ->pluck('document_id');
//
//        $get =  DB::table('document')
//            ->whereIn('id', $getStatus)
//            ->get('documentCode','data');
//
//        return response()->json([
//            "result" => $get
//        ]);
//    }

    public function getAllDocumentAndStatus()
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"document","viewStatusDocument");
        $get =  DB::table('document')
            ->select('document.id', 'document.document_code','document.data','status.name')
            ->join('workflow', 'document.id', '=', 'workflow.document_id')
            ->join('status', 'status.id', '=', 'workflow.status_id')
            ->get();

        return response()->json([
            "result" => $get
        ]);
    }
}

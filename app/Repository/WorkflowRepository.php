<?php

namespace App\Repository;


use App\service\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WorkflowRepository implements IWorkflowRepository
{

    private IUserRepository $userRepository;
    private IStatusRepository $statusRepository;
    private IDocumentRepository $documentRepository;
    private PermissionService $permissionService;

    public function __construct(
        IUserRepository $iUserRepository,
        IStatusRepository $iStatusRepository,
        IDocumentRepository $iDocumentRepository,
        PermissionService $permissionService)
    {
        $this->userRepository = $iUserRepository;
        $this->statusRepository = $iStatusRepository;
        $this->documentRepository = $iDocumentRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * Check id status and id document
     * @param $idStatus
     * @param $idDoc
     * @return bool
     */
    public function checkIdStatusAndDoc($idStatus, $idDoc)
    {
        $isDoc = $this->documentRepository->checkIdDocument($idDoc);
        $isStatus = $this->statusRepository->checkIdStatus($idStatus);

        if($isStatus == true && $isDoc == true)
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * check id
     * @param $id
     * @return bool
     */
    public function checkIdWorkflow($id)
    {
        $isWorkflow = DB::table('workflow')->find($id);
        if(!is_null($isWorkflow)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function createWorkflow(array $data)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"workflow","create");
        if ($isAdmin == true  || $isRole == true)  {
            $validator = Validator::make($data, [
                'status_id' => 'required|uuid',
                'document_id' => 'required|uuid|unique:workflow'
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
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @param $id
     * @param array $data
     * @return JsonResponse
     */
    public function updateWorkflow($id, array $data)
    {
        $validator = Validator::make($data, [
            'status_id' => 'required|uuid',
            'document_id' => 'required|uuid',
        ]);
        if ($validator->fails()) {
            return response()->json(
                ["message" => $validator->errors()],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }

        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"workflow","update");
        if ($isAdmin == true || $isRole == true) {
            if($this->checkIdWorkflow($id) == true)
            {
                return response()->json([
                    "result" => DB::table('workflow')->where('id', $id)->update($data)
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json([
                   "error" => "Not Found"
                ], ResponseAlias::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteWorkflow($id)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"workflow","delete");
        if ($isAdmin == true || $isRole == true)
        {
            if($this->checkIdWorkflow($id) == true)
            {
                return response()->json(["result" => DB::table('workflow')->delete($id)
                ], ResponseAlias::HTTP_OK);
            } else {
                return response()->json(
                    ["error"=>"Not Found"],
                    ResponseAlias::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json([
                "message" => "You Do Not Have Access",
            ],ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getAllWorkflow()
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"workflow","view");
        if ($isAdmin == true || $isRole == true) {
          return response()->json([
              "result" => DB::table('workflow')
                  ->orderByDesc('created_at')
                  ->get()
          ],ResponseAlias::HTTP_OK);
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }
    }

    public function findWorkflowById($id)
    {
        $isAdmin = $this->userRepository->checkRole(Auth::id());
        $isRole = $this->permissionService->checkPermission(Auth::id(),"workflow","find");
        if ($isAdmin == true || $isRole == true)
        {
            $data = DB::table('workflow')->find($id);
            if(!is_null($data)) {
                return response()->json([
                    "result" => $data
                ]);
            } else {
                return response()->json([
                    ["message" => "Not Found"],
                    ResponseAlias::HTTP_UNAUTHORIZED
                ]);
            }
        } else {
            return response()->json(
                ["message" => "You Do Not Have Access"],
                ResponseAlias::HTTP_UNAUTHORIZED
            );
        }
    }
}

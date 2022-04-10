<?php

namespace App\Repository;
use App\Repository\IDocumentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DocumentRepository implements IDocumentRepository
{

    private IUserRepository $iUserRepository;

    public function __construct(IUserRepository $iUserRepository)
    {
        $this->iUserRepository = $iUserRepository;
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function createDocument($data)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        if ($isAdmin == true) {
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
                "message" => "You are not admin"],
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
        if ($isAdmin == true) {
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
                "message" => "You are not admin"],
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
        if ($isAdmin == true) {
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
                "message" => "You are not admin"],
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
        if ($isAdmin == true) {
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
                "message" => "You are not admin"],
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
        if ($isAdmin == true) {
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
                "message" => "You are not admin"],
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
        if ($isAdmin == true) {
            return response()->json([
                "result" => DB::table('document')->get()
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "message" => "You are not admin"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function findStatusByIdDocument($id)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        if ($isAdmin == true) {
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
                "message" => "You are not admin"],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }
}

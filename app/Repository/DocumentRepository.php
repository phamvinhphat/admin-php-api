<?php

namespace App\Repository;
use App\Repository\IDocumentRepository;
use Illuminate\Http\JsonResponse;
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

        return response()->json([
            "result" => DB::table('document')
                ->insert($data)
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findDocumentById($id)
    {
       $doc = DB::table('document')->where('id', $id)->first();
       if(!is_null($doc))
       {
           return response()->json([
               "result" => $doc
           ], ResponseAlias::HTTP_OK);
       } else {
           return response()->json(['message', 'Not Found']);
       }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteDocumentById($id)
    {
        if($this->checkIdDocument($id) == true)
        {
            return response()->json([
                "result" => DB::table('document')->delete($id)
            ], ResponseAlias::HTTP_OK);
        } else {
            return response()->json([
                "error" => "Not Found"
            ], ResponseAlias::HTTP_BAD_REQUEST);
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

        if($this->checkIdDocument($id) == true)
        {
            return response()->json([
               "result" => DB::table('document')
                   ->where('id', $id)
                   ->update($data)
            ]);
        } else {
            return response()->json([
                "error" => "Not Found"
            ]);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function findDocumentByIdUser($id)
    {
        if($this->iUserRepository->findUserById($id) == true )
        {
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
        return response()->json([
            "result" => DB::table('document')->get()
        ], ResponseAlias::HTTP_OK);
    }

}

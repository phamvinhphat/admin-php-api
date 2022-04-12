<?php

namespace App\Http\Controllers;

use App\Repository\IPermissionRoleRepository;
use App\Repository\IStatusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class StatusController extends Controller
{
    private IStatusRepository $statusRepository;

    public function __construct(IStatusRepository $iStatusRepository)
    {
        $this->statusRepository = $iStatusRepository;
        $this->middleware('auth:api');
    }

    public function createdStatus(Request $request)
    {
        $id =  Uuid::uuid4()->toString();
        $name = $request->get('name');
        $parentN = $request->get('parent_n');
        $current_date_time = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array(
            "id" => $id,
            "name" => $name,
            "parent_n" => $parentN,
            "modified_by_id" => Auth::id(),
            "created_by_id" => Auth::id(),
            "created_at" => $current_date_time,
            "updated_at"=> $current_date_time,
        );
        return $this->statusRepository->createStatus($data);
    }

    public function findStatusById(Request $request)
    {
        $id = $request->route('id');
        return $this->statusRepository->findStatusById($id);
    }

    public function getAllStatus()
    {
        return $this->statusRepository->getAllStatus();
    }

    public function checkStatus(Request $request)
    {
        $id = $request->route('id');
        return response()->json(["result"=>$this->statusRepository->checkIdStatus($id)]);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->route('id');
        $name = $request->get('name');
        $parentN = $request->get('parent_n');

        $data = array(
            'name' => $name,
            'parent_n' => $parentN,
        );

        return $this->statusRepository->updateStatusById($id, $data);
    }

    public function deleteStatus(Request $request)
    {
        $id = $request->route('id');
        return $this->statusRepository->deleteStatusById($id);
    }

    public function findStatusByMyId()
    {
        return $this->statusRepository->findStatusByMyId(Auth::id());
    }

}

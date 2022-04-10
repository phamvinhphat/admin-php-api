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
    private IStatusRepository $iStatusRepository;

    public function __construct(IStatusRepository $iStatusRepository)
    {
        $this->iStatusRepository = $iStatusRepository;
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
        return $this->iStatusRepository->createStatus($data);
    }

    public function findStatusById(Request $request)
    {
        $id = $request->route('id');
        return $this->iStatusRepository->findStatusById($id);
    }

    public function getAllStatus()
    {
        return $this->iStatusRepository->getAllStatus();
    }

    public function checkStatus(Request $request)
    {
        $id = $request->route('id');
        return response()->json(["result"=>$this->iStatusRepository->checkIdStatus($id)]);
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

        return $this->iStatusRepository->updateStatusById($id, $data);
    }

    public function deleteStatus(Request $request)
    {
        $id = $request->route('id');
        return $this->iStatusRepository->deleteStatusById($id);
    }

    public function findStatusByMyId()
    {
        return $this->iStatusRepository->findStatusByMyId(Auth::id());
    }

}

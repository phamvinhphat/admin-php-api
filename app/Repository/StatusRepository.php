<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StatusRepository implements IStatusRepository
{

    private IUserRepository $iUserRepository;

    public function __construct(IUserRepository $iUserRepository)
    {
        $this->iUserRepository = $iUserRepository;
    }

    public function createStatus(array $data)
    {
        $isAdmin = $this->iUserRepository->checkRole(Auth::id());
        if ($isAdmin == true) {


        } else {
            return response()->json([
                'error' => 'You are not admin'],
                ResponseAlias::HTTP_FORBIDDEN
            );
        }
    }

    public function findStatusById($id)
    {
        // TODO: Implement findStatusById() method.
    }

    public function getAllStatus($id)
    {
        // TODO: Implement getAllStatus() method.
    }
}

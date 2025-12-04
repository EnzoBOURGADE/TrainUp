<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FriendsModel;
use App\Models\MusclesModel;
use App\Models\UserModel;
use App\Models\ExerciceModel;
use App\Models\ProgramModel;
use App\Models\FriendModel;
use App\Models\MuscleModel;
use App\Models\UserPermissionModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $exerciceModel = new ExerciceModel();
        $programModel = new ProgramModel();
        $friendModel = new FriendsModel();
        $muscleModel = new MusclesModel();
        $permissionModel = new UserPermissionModel();

        $data = [
            'users' => $userModel->countAllResults(),
            'exercices' => $exerciceModel->countAllResults(),
            'programmes' => $programModel->countAllResults(),
            'amities' => $friendModel->countAllResults(),
            'muscles' => $muscleModel->countAllResults(),
            'permissions' => $permissionModel->countAllResults(),
        ];
        return view('admin/dashboard', $data);
    }
}

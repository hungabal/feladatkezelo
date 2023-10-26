<?php

namespace App\Services;

use App\Models\UsersModel;

class UserService
{
    public function __construct()
    {

    }

    public function list()
    {
        $users = UsersModel::get();

        return json_encode($users);
    }
}

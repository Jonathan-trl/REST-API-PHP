<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function get($id = null)
    {
        if ($id) {
            return User::getUser($id);
        } else {
            return User::getAllUsers();
        }
    }

    public function post()
    {
        $data = file_get_contents("php://input");
        return User::storeUser($data);
    }

    public function put($id)
    {
        $data = file_get_contents("php://input");
        return User::updateUser($id, $data);
    }

    public function delete()
    {
        return User::deleteUser($_POST);
    }
}

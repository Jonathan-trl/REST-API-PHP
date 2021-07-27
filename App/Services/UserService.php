<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function get($id = null)
    {
        if ($id) {
            return User::find($id);
        } else {
            return User::findAll();
        }
    }

    public function post()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function delete()
    {
        # code...
    }
}

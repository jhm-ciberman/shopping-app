<?php

namespace App\Http\Controllers\Admin;

use App\Admin\UserResource;

class UserController extends ResourceController
{
    protected function makeResource()
    {
        return new UserResource();
    }
}

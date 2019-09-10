<?php

namespace App\Admin;

use App\User;

class UserResource extends Resource
{
    protected $viewName = 'users';

    public function columns() 
    {
        return [
            'id'    => 'Id',
            'name'  => 'Name',
            'email' => 'Email',
        ];
    }

    public function createIndexQuery() 
    {
        return User::query();
    }

}
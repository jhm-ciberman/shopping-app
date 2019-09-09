<?php

namespace App\Admin;

use App\User;

class UserResource extends Resource
{

    public function columns() 
    {
        return [
            'id'    => 'Id',
            'name'  => 'Name',
            'email' => 'Email',
        ];
    }

    public function endpoint() 
    {
        return route('admin.users.index');
    }

    public function createIndexQuery() 
    {
        return User::query();
    }

    public function createView()
    {
        return view('admin.users.create');
    }

}
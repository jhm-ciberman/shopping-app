<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Boolean;
use App\User;

class UserResource extends Resource
{
    public $viewName = 'users';

    public $model = User::class;

    public $name = "User";

    public $title = 'name';

    public function fields()
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Text::make('Email', 'email'),
            Boolean::make('Is admin', 'is_admin'),
        ];
    }
}

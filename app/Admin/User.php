<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Boolean;
use App\Admin\Core\Resource;

class User extends Resource
{
    public $viewName = 'users';

    public static $model = 'App\User';

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

<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Date;
use App\Admin\Fields\Boolean;
use App\Admin\Fields\HasMany;
use App\Admin\Core\Resource;

class User extends Resource
{
    public static $model = 'App\User';

    public $title = 'name';

    public $canCreate = false;

    public function fields()
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Text::make('Email', 'email'),
            Boolean::make('Is admin', 'is_admin'),
            Date::make('Created at', 'created_at')->exceptOnForms(),
            Date::make('Updated at', 'updated_at')->exceptOnForms(),

            HasMany::make('Orders', 'orders', 'App\Admin\Order'),
        ];
    }
}

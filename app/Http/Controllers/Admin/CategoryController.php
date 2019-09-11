<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CategoryResource;

class CategoryController extends ResourceController
{
    protected function makeResource()
    {
        return new CategoryResource();
    }
}

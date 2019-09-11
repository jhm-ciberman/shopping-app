<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ProductResource;

class ProductController extends ResourceController
{
    protected function makeResource()
    {
        return new ProductResource();
    }
}

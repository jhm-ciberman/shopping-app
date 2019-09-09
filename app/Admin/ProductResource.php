<?php

namespace App\Admin;

use App\Product;

class ProductResource extends Resource
{

    public function columns() 
    {
        return [
            'id'    => 'Id',
            'name'  => 'Name',
            'description' => 'Description',
        ];
    }

    public function endpoint() 
    {
        return route('admin.products.index');
    }

    public function createIndexQuery() 
    {
        return Product::query();
    }

    public function createView()
    {
        return view('admin.products.create');
    }

}
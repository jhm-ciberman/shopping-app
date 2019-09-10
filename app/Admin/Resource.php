<?php

namespace App\Admin;

abstract class Resource 
{
    protected $viewName = '';

    public abstract function columns();

    public abstract function createIndexQuery();

    public function endpoint() 
    {
        return route('admin.'.$this->viewName.'.index');
    }

    public function createView()
    {
        return view('admin.'.$this->viewName.'.create');
    }

    public function editView() 
    {
        return view('admin.'.$this->viewName.'.edit');
    }

    public function indexView() 
    {
        return view('admin.index', [
            'endpoint' => $this->endpoint(),
            'columns' => $this->getColumnData(),
        ]);
    }

    protected function getColumnData()
    {
        return collect($this->columns())
            ->map(function($value, $key) {
                return [
                    'key' => $key,
                    'name' => $value
                ];
            })
            ->values();
    }

    public function jsonIndexResponse()
    {
        $attributeNames = collect($this->columns())->keys()->toArray();

        return $this->createIndexQuery()
            ->select($attributeNames)
            ->paginate();
    }
}
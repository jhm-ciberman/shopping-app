<?php

namespace App\Admin;

abstract class Resource 
{
    public abstract function columns();

    public abstract function endpoint();

    public abstract function createIndexQuery();

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

    public abstract function createView();
}
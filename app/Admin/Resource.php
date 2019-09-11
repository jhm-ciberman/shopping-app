<?php

namespace App\Admin;

abstract class Resource
{
    public $viewName = '';

    public $model;

    public $name;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public $title = 'id';

    public function fields()
    {
        return [];
    }

    public function newQuery()
    {
        return $this->newModel()->query();
    }

    public function createIndexQuery()
    {
        return $this->newQuery()->orderBy('id', 'desc');
    }

    public function createFindQuery($id)
    {
        return $this->newQuery()->where('id', $id);
    }

    public function newModel()
    {
        return new $this->model;
    }

    public function indexFields()
    {
        return $this->filterFields('showOnIndex');
    }

    public function detailFields()
    {
        return $this->filterFields('showOnDetail');
    }

    public function editFields()
    {
        return $this->filterFields('showOnUpdate');
    }

    public function createFields()
    {
        return $this->filterFields('showOnCreation');
    }

    protected function filterFields($attr)
    {
        return collect($this->fields())
            ->filter(function($field) use ($attr) {
                return $field->{$attr};
            });
    }
}

<?php

namespace App\Admin\Fields;

use Str;

abstract class Field
{
    /**
     * The displayable name of the field.
     *
     * @var string
     */
    public $name;

    /**
     * The attribute / column name of the field.
     *
     * @var string
     */
    public $attribute;

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = true;

    /**
     * Indicates if the element should be shown on the detail view.
     *
     * @var bool
     */
    public $showOnDetail = true;

    /**
     * Indicates if the element should be shown on the creation view.
     *
     * @var bool
     */
    public $showOnCreation = true;

    /**
     * Indicates if the element should be shown on the update view.
     *
     * @var bool
     */
    public $showOnUpdate = true;

    /**
     * The view name
     *
     * @var string
     */
    protected $view;

    public function __construct($name, $attribute = null)
    {
        $this->name = $name;

        $this->attribute = $attribute ?? str_replace(' ', '_', Str::lower($name));
    }


    /**
     * Specify that the element should be hidden from the index view.
     *
     * @return $this
     */
    public function hideFromIndex()
    {
        $this->showOnIndex = false;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the detail view.
     *
     * @return $this
     */
    public function hideFromDetail()
    {
        $this->showOnDetail = false;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the creation view.
     *
     * @return $this
     */
    public function hideWhenCreating()
    {
        $this->showOnCreation = false;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the update view.
     *
     * @return $this
     */
    public function hideWhenUpdating()
    {
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on the index view.
     *
     * @return $this
     */
    public function onlyOnIndex()
    {
        $this->showOnIndex = true;
        $this->showOnDetail = false;
        $this->showOnCreation = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on the detail view.
     *
     * @return $this
     */
    public function onlyOnDetail()
    {
        $this->showOnIndex = false;
        $this->showOnDetail = true;
        $this->showOnCreation = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on forms.
     *
     * @return $this
     */
    public function onlyOnForms()
    {
        $this->showOnIndex = false;
        $this->showOnDetail = false;
        $this->showOnCreation = true;
        $this->showOnUpdate = true;

        return $this;
    }

    /**
     * Specify that the element should be hidden from forms.
     *
     * @return $this
     */
    public function exceptOnForms()
    {
        $this->showOnIndex = true;
        $this->showOnDetail = true;
        $this->showOnCreation = false;
        $this->showOnUpdate = false;

        return $this;
    }


    public function view()
    {
        return $this->view ?? Str::kebab(class_basename($this));
    }

    public static function make(... $arguments)
    {
        return new static(... $arguments);
    }

    public function resolve($model, $attribute = null)
    {
        $attribute = $attribute ?? $this->attribute;

        return $model->{$attribute};
    }

    public function jsonSerialize()
    {
        return [
            'attribute' => $this->attribute,
            'name'      => $this->name
        ];
    }
}

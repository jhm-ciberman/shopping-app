<?php

namespace App\Admin\Core;

use Illuminate\Http\Resources\DelegatesToResource;
use Str;

abstract class Resource
{
    use DelegatesToResource;

    /**
     * The model name
     *
     * @var string
     */
    public static $model;

    /**
     * The underlaying model resource instance
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $resource;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public $title = 'id';

    /**
     * Create a new resource instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $resource
     * @return void
     */
    public function __construct($resource = null)
    {
        $this->resource = $resource;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public abstract function fields();

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey()
    {
        return Str::plural(Str::kebab(class_basename(get_called_class())));
    }

    public static function newModel()
    {
        return new static::$model();
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

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return Str::plural(Str::title(Str::snake(class_basename(get_called_class()), ' ')));
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return Str::singular(static::label());
    }

    public function indexQuery($query)
    {
        $query->orderBy('id', 'desc');
    }
}

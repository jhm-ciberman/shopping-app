<?php

namespace App\Admin\Fields;

abstract class Relationship extends Field
{

    protected $resourceClass;

    public function __construct($name, $attribute = null, $resource = null)
    {
        parent::__construct($name, $attribute);

        $this->resourceClass = $resource;
    }

    public function toEndpointParams($viaResource)
    {
        return [
            'viaResource' => $viaResource::uriKey(),
            'viaResourceId' => $viaResource->id,
            'viaRelationship' => $this->attribute,
        ];
    }

    public function relationship($resource)
    {
        return $resource->{$this->attribute}();
    }

    public function newResource()
    {
        return new $this->resourceClass;
    }

    public function indexFields()
    {
        return $this->newResource()->indexFields();
    }
}

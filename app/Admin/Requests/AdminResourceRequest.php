<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Admin\Core\Admin;

class AdminResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Get the class name of the resource being requested.
     *
     * @return mixed
     */
    public function resource()
    {
        return tap(Admin::resourceForKey($this->route('resource')), function ($resource) {
            abort_if(is_null($resource), 404);
        });
    }

    /**
     * Get a new instance of the resource being requested.
     *
     * @return \Laravel\Nova\Resource
     */
    public function newResource()
    {
        $resource = $this->resource();

        return new $resource($this->model());
    }

    /**
     * Get a new query builder for the underlying model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        if (! $this->viaRelationship()) {
            return $this->model()->newQuery();
        }

        return forward_static_call([$this->viaResource(), 'newModel'])
            ->newQueryWithoutScopes()->findOrFail(
                $this->viaResourceId
            )->{$this->viaRelationship}();
    }

    /**
     * Get a new, scopeless query builder for the underlying model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQueryWithoutScopes()
    {
        return $this->model()->newQueryWithoutScopes();
    }

    /**
     * Get the query to find the model instance for the request.
     *
     * @param  mixed|null  $resourceId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findModelQuery($resourceId = null)
    {
        return $this->newQueryWithoutScopes()->whereKey(
            $resourceId ?? $this->resourceId
        );
    }

    /**
     * Find the resource model instance for the request.
     *
     * @param  mixed|null  $resourceId
     * @return \Laravel\Nova\Resource
     */
    public function findResourceOrFail($resourceId = null)
    {
        return $this->newResourceWith($this->findModelOrFail($resourceId));
    }

    /**
     * Find the model instance for the request.
     *
     * @param  mixed|null  $resourceId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findModelOrFail($resourceId = null)
    {
        if ($resourceId) {
            return $this->findModelQuery($resourceId)->firstOrFail();
        }

        $this->findModelQuery()->firstOrFail();
    }

    /**
     * Get a new instance of the resource being requested.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Laravel\Nova\Resource
     */
    public function newResourceWith($model)
    {
        $resource = $this->resource();

        return new $resource($model);
    }

    /**
     * Get the class name of the "related" resource being requested.
     *
     * @return string
     */
    public function relatedResource()
    {
        return Admin::resourceForKey($this->relatedResource);
    }

    /**
     * Get a new instance of the "related" resource being requested.
     *
     * @return \Laravel\Nova\Resource
     */
    public function newRelatedResource()
    {
        $resource = $this->relatedResource();

        return new $resource($resource::newModel());
    }

    /**
     * Get a new instance of the underlying model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        $resource = $this->resource();

        return $resource::newModel();
    }

    /**
     * Get a new instance of the "via" resource being requested.
     *
     * @return \Laravel\Nova\Resource
     */
    public function newViaResource()
    {
        $resource = $this->viaResource();

        return new $resource($resource::newModel());
    }

    /**
     * Get the class name of the "via" resource being requested.
     *
     * @return string
     */
    public function viaResource()
    {
        return Admin::resourceForKey($this->viaResource);
    }

    /**
     * Determine if the request is via a relationship.
     *
     * @return bool
     */
    public function viaRelationship()
    {
        return $this->viaResource && $this->viaResourceId && $this->viaRelationship;
    }
}

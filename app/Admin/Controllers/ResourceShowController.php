<?php

namespace App\Admin\Controllers;

use App\Admin\Fields\Relationship;
use App\Admin\Fields\ListableField;
use App\Admin\Requests\AdminResourceRequest;

class ResourceShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $model = $request->findModelQuery()->firstOrFail();
        $resource = $request->newResourceWith($model);

        return view('admin.show', [
            'title' => $resource::singularLabel(),
            'resource' => $resource,
            'fields' => $resource->detailFields(),
            'relationshipFields' => $resource->listableDetailFields(),
            'editUrl' => $this->resourceRoute($resource, 'edit', $model),
            'destroyUrl' => $this->resourceRoute($resource, 'destroy', $model),
        ]);
    }
}

<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;

class ResourceStoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $resource = $request->newResource();
        $resource->authorizeTo('create');

        $resource->fill($request);
        $resource->save();

        $this->updateModel($model, $resource->editFields());

        if (request()->expectsJson()) {
            return $model;
        }

        return redirect($this->resourceRoute($resource, 'index'));
    }
}

<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;

class ResourceUpdateController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $model = $request->findModelQuery()->firstOrFail();
        $resource = $request->newResourceWith($model);

        $resource->authorizeTo('edit');

        $resource->fill($request);
        $resource->save();

        if (request()->expectsJson()) {
            return $model;
        }

        return redirect($this->resourceRoute($resource, 'show', $model));
    }
}

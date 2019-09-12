<?php

namespace App\Admin\Controllers;

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
            'title'      => $resource::singularLabel(),
            'model'      => $model,
            'fields'     => $resource->detailFields(),
            'editUrl'    => $this->resourceRoute($resource, 'edit', $model),
            'destroyUrl' => $this->resourceRoute($resource, 'destroy', $model),
        ]);
    }
}

<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;

class ResourceEditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $model = $request->findModelQuery()->firstOrFail();
        $resource = $request->newResourceWith($model);

        return view('admin.edit', [
            'title'  => 'Edit '.$resource::singularLabel(),
            'model'  => $model,
            'action' => $this->resourceRoute($resource, 'update', $model),
            'method' => 'PUT',
            'fields' => $resource->editFields(),
        ]);
    }
}

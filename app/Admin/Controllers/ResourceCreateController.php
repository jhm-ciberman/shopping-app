<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;

class ResourceCreateController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $resource = $request->newResource();

        return view('admin.edit', [
            'title'     => 'Create '.$resource::singularLabel(),
            'model'     => $resource->newModel(),
            'action'    => $this->resourceRoute($resource, 'index'),
            'method'    => 'POST',
            'fields'    => $resource->createFields(),
        ]);
    }
}

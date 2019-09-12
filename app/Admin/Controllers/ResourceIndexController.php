<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;
use Str;

class ResourceIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $resource = $request->newResource();

        if ($request->expectsJson()) {
            $query = $request->newQuery();
            $resource->indexQuery($query);
            return $query->paginate();
        }

        return view('admin.index', [
            'title'     => $resource::label(),
            'endpoint'  => $this->resourceRoute($resource, 'index'),
            'createUrl' => $this->resourceRoute($resource, 'create'),
            'fields'    => $request->newResource()->indexFields(),
        ]);
    }

}

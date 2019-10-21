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
        $resource = ($request->viaRelationship())
            ? $request->newViaResource()
            : $request->newResource();

        if ($request->expectsJson()) {
            $query = $request->newQuery();
            $resource->indexQuery($query);
            $paginator = $query->paginate();
            $collection = $paginator->getCollection()->mapInto($request->resource())->map->serializeForIndex();

            return $paginator->setCollection($collection);
        }

        return view('admin.index', [
            'resource'  => $resource,
            'title'     => $resource::label(),
            'fields'    => $resource->indexFields(),
        ]);
    }

}

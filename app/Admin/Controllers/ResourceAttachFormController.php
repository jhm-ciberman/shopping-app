<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;

class ResourceAttachFormController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $resource = $request->newResource();
        $relatedResource = $request->newRelatedResource();

        $query = $relatedResource->newQuery();
        $relatedResource->indexQuery($query);

        return view('admin.attach', [
            'title'  => 'Attach '.$relatedResource::singularLabel(),
            'resource' => $relatedResource,
            'attachables'  => $query->get(),
            'action' => route('admin.resources.attach', [
                'resource'   => $resource::uriKey(),
                'resourceId' => $request->resourceId,
                'relatedResource' => $relatedResource::uriKey(),
            ]),
            'method' => 'PUT',
        ]);
    }
}

<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;
use App\Admin\Core\Admin;

class ResourceAttachController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $request->validate([
            'attachableId' => 'numeric',
        ]);

        $model = $request->findModelQuery()->firstOrFail();
        $resource = $request->newResourceWith($model);

        $relationship = $resource->resource->{$request->relatedResource}();

        $attachableResource = $request->newRelatedResource()->findOrFail(+$request->attachableId);

        $relationship->attach($attachableResource);

        return redirect()->route('admin.resources.show', [
            'resource' => $resource::uriKey(),
            'resourceId' => $request->resourceId,
        ]);
    }
}

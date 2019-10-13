<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\AdminResourceRequest;

class ResourceDestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function handle(AdminResourceRequest $request)
    {
        $model = $request->findModelQuery()->firstOrFail();
        $resource = $request->newResourceWith($model);
        $resource->authorizeTo('delete');

        $resource->delete();

        if (request()->expectsJson()) {
            return;
        }

        return redirect($this->route('index'));
    }
}

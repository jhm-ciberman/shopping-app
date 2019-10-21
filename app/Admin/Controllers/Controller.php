<?php

namespace App\Admin\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function resourceRoute($resource, $action, $model = null)
    {
        return route('admin.resources.'.$action, array_merge(
            $model ? ['resourceId' => $resource->getKey()] : [],
            ['resource' => $resource::uriKey()]
        ));
    }

}

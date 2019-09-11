<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

abstract class ResourceController extends Controller
{

    protected $resource;

    public function __construct()
    {
        $this->middleware('auth');

        $this->resource = $this->makeResource();
    }

    protected abstract function makeResource();

    protected function firstOrFail($id)
    {
        return $this->resource->createFindQuery($id)->firstOrFail();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->resource->createIndexQuery()->paginate();
        }

        return view('admin.index', [
            'title'     => Str::plural($this->resource->name),
            'endpoint'  => $this->route('index'),
            'fields'    => $this->resource->indexFields(),
            'createUrl' => $this->route('create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.edit', [
            'title'     => 'Create '.$this->resource->name,
            'model'     => $this->resource->newModel(),
            'action'    => $this->route('store'),
            'method'    => 'POST',
            'fields'    => $this->resource->createFields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $this->newModel();

        $this->updateModel($model, $this->resource->editFields());

        if (request()->expectsJson()) {
            return $model;
        }

        return redirect($this->route('index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->firstOrFail($id);

        return view('admin.show', [
            'title'      => $model->{$this->resource->title},
            'model'      => $model,
            'fields'     => $this->resource->detailFields(),
            'editUrl'    => $this->route('edit', $model),
            'destroyUrl' => $this->route('destroy', $model),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->firstOrFail($id);

        return view('admin.edit', [
            'title'  => 'Edit '.$this->resource->name,
            'model'  => $model,
            'action' => $this->route('update', $model),
            'method' => 'PUT',
            'fields' => $this->resource->editFields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->firstOrFail($id);

        $this->updateModel($model, $this->resource->editFields());

        if (request()->expectsJson()) {
            return $model;
        }

        return redirect($this->route('show', $model));
    }

    protected function updateModel($model, $fields)
    {
        $attributes = $fields->pluck('attribute')->toArray();

        $model->forceFill(request()->only($attributes));

        $model->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->firstOrFail($id)->delete();

        if (request()->expectsJson()) {
            return;
        }

        return redirect($this->route('index'));
    }

    protected function route($action, $model = [])
    {
        return route('admin.'.$this->resource->viewName.'.'.$action, $model);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\Backend\Pages\Store as PagesStore;
use App\Http\Requests\Backend\Tags\Store;
use App\Models\Page;

class Pages extends BackEndController
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function store(PagesStore $request)
    {
        $this->model->create($request->all());

        return redirect()->route('pages.index');
    }
    // protected function filter($rows)
    // {
    //     if(request()->has('name') && request()->get('name') != "")
    //     $rows = $rows->where('name' , request()->get('name'));
    //     return $rows;

    // }
    public function update($id, Store $request)
    {
        $row = $this->model->findOrFail($id);
        $row->update($request->all());
        //return redirect()->route('users.index');
        return redirect()->route('pages.edit', $row->id);
    }
}

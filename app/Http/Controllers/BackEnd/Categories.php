<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BackEnd\categories\Store;
use App\Models\Category;


class Categories extends BackEndController
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }


    public function store(Store $request)
    {
        $this->model->create($request->all());

        return redirect()->route('categories.index');
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
        return redirect()->route('categories.edit', $row->id);
    }
}

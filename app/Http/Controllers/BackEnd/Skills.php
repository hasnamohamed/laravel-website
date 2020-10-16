<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Skills\Store;
use App\Models\Skill;

class Skills extends BackEndController
{
    public function __construct(Skill $model)
    {
        parent::__construct($model);
    }

    public function store(Store $request)
    {
        $this->model->create($request->all());

        return redirect()->route('skills.index');
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
        return redirect()->route('skills.edit', $row->id);
    }
}

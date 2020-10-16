<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use  App\Http\Requests\BackEnd\Users\Store;
use  App\Http\Requests\BackEnd\Users\Update;
use Validator;

class Users extends BackEndController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function store(Store $request)
    {
        $requestArray = $request->all();
        $requestArray['password'] = Hash::make($requestArray['password']);
        $this->model->create($requestArray);
        return redirect()->route('users.index');
    }
    // protected function filter($rows)
    // {
    //     if(request()->has('name') && request()->get('name') != "")
    //     $rows = $rows->where('name' , request()->get('name'));
    //     return $rows;

    // }

    public function update($id, Update $request)
    {
        $row = $this->model->findOrFail($id);
        $requestArray = $request->all();
        if (isset($requestArray['password']) && $requestArray['password']  != "") {
            $requestArray['password'] = Hash::make($requestArray['password']);
        } else {
            unset($requestArray['password']);
        }
        $row->update($requestArray);
        //return redirect()->route('users.index');
        return redirect()->route('users.edit', $row->id);
    }
}

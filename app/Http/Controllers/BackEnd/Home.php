<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;

class Home extends BackEndController // the backend controler extends from the basic controller so i deleted the basic cntroller and extendes from backendcontroller
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $comments = Comments::with('user', 'video')->orderBy('id', 'desc')->paginate(20);
        return view('back-end.home', compact('comments'));
    }
}

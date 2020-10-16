<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;


class BackEndController extends Controller
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        $rows = $this->model;
        // dd($this->getClassNameFromModel()); //will return User the name of the class of model
        $rows = $this->filter($rows);
        $with = $this->with();
        if (!empty($with)) {
            $rows = $rows->with($with);
        }
        $rows = $rows->paginate(10);
        $moduleName = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();
        $pageTitle = 'Control ' . $moduleName;
        $pageDes = 'Here you can add / edit / delete ' . $moduleName;


        //$rows = DB::table('users')->paginate(10);
        return view('back-end.' . $this->getClassNameFromModel() . '.index', compact(
            'rows',
            'pageTitle',
            'moduleName',
            'pageDes',
            'sModuleName',
            'routeName'
        ));
    }
    public function create()
    {
        $moduleName = $this->getModelName();
        $pageTitle =  'Create ' . $moduleName;
        $pageDes = 'Here you can create ' . $moduleName;
        $folderName = $this->getClassNameFromModel();
        $routeName = $this->getClassNameFromModel();
        $append = $this->append();
        return view('back-end.' . $folderName . '.create', compact(
            'pageTitle',
            'moduleName',
            'pageDes',
            'folderName',
            'routeName'
        ))->with($append);
    }

    public function edit($id)
    {
        $moduleName = $this->getModelName();
        $pageTitle =  'Edit ' . $moduleName;
        $pageDes = 'Here you can edit ' . $moduleName;
        $row = $this->model->findOrFail($id);
        $routeName = $this->getClassNameFromModel();
        $folderName = $this->getClassNameFromModel();
        $append = $this->append();

        return view('back-end.' . $folderName . '.edit', compact(
            'row',
            'pageTitle',
            'moduleName',
            'pageDes',
            'folderName',
            'routeName'
        ))->with($append);
    }

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->route($this->getClassNameFromModel() . '.index');
    }
    protected function filter($rows)
    {
        return $rows;
    }
    protected function with()
    {
        return [];
    }
    protected function getClassNameFromModel()
    {
        return strtolower($this->pluralModelName()); //i give it the model and it return the class name
    }
    protected function pluralModelName()
    {
        return str::plural($this->getModelName());
    }
    protected function getModelName()
    {
        return class_basename($this->model);
    }
    protected function append()
    {
        return [];
    }
}

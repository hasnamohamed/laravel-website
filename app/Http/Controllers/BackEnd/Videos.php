<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\Backend\Videos\Store;
use App\Http\Requests\Backend\Videos\Update;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Video;

class Videos extends BackEndController
{
    use CommentTrait;
    public function __construct(Video $model)
    {
        parent::__construct($model);
    }
    // public function index(){
    //     $rows = $this->model->with('cat','user');
    //    // dd($this->getClassNameFromModel()); //will return User the name of the class of model
    //    $rows = $this->filter($rows);
    //    $rows = $rows->paginate(10);
    //    $moduleName= $this->pluralModelName();
    //    $sModuleName = $this->getModelName();
    //    $routeName=$this->getClassNameFromModel();
    //    $pageTitle = 'Control '.$moduleName ;
    //    $pageDes = 'Here you can add / edit / delete '. $moduleName;


    //    //$rows = DB::table('users')->paginate(10);
    //    return view('back-end.'.$this->getClassNameFromModel().'.index', compact(
    //        'rows',
    //        'pageTitle',
    //        'moduleName',
    //        'pageDes',
    //        'sModuleName',
    //        'routeName'
    //     ));
    // }
    protected function with()
    {
        return ['cat', 'user'];
    }
    // public function create(){
    //     $moduleName= $this->getModelName();
    //     $pageTitle =  'Create '.$moduleName;
    //     $pageDes = 'Here you can create '. $moduleName;
    //     $folderName=$this->getClassNameFromModel();
    //     $routeName=$this->getClassNameFromModel();
    //     $categories=Category::get();
    //     return view('back-end.'.$folderName.'.create', compact(
    //         'pageTitle',
    //        'moduleName',
    //        'pageDes',
    //        'folderName',
    //        'routeName',
    //        'categories'
    //     ));
    //  }

    // public function edit($id){
    //     $moduleName= $this->getModelName();
    //     $pageTitle =  'Edit '.$moduleName;
    //     $pageDes = 'Here you can edit '. $moduleName;
    //     $row=$this->model->findOrFail($id);
    //     $routeName=$this->getClassNameFromModel();
    //     $categories=Category::get();

    //     $folderName=$this->getClassNameFromModel();
    //     return view('back-end.'.$folderName.'.edit', compact(
    //         'row',
    //         'pageTitle',
    //        'moduleName',
    //        'pageDes',
    //        'folderName',
    //        'routeName',
    //        'categories'
    //     ));
    // }
    protected function append()
    {

        $array = [
            'categories' => Category::get(),
            'skills' => Skill::get(),
            'selectedSkills' => [],
            'tags' => Tag::get(),
            'selectedTags' => [],
            'comments' => []

        ];
        if (request()->route()->parameter('video')) {
            $array['selectedSkills'] = $this->model->find(request()->route()->parameter('video')) #give us the vedio
                ->skills()->pluck('skills.id')->toArray(); #id of skills of that video
            $array['selectedTags'] = $this->model->find(request()->route()->parameter('video')) #give us the vedio
                ->tags()->pluck('tags.id')->toArray(); #id of skills of that video
            $array['comments'] = $this->model->find(request()->route()->parameter('video')) #give us the vedio
                ->comments()->orderBy('id', 'desc')->with('user')->get();
        }

        return $array;
    }
    public function store(Store $request)
    {
        $filename = $this->uploadImage($request);
        $requestArray = ['user_id' => auth()->user()->id, 'image' => $filename] + $request->all();
        $row = $this->model->create($requestArray);
        //     if(isset($requestArray['skills']) && !empty($requestArray['skills'])){
        //          $row->skills()->sync($requestArray['skills']);
        //     }
        //     if(isset($requestArray['tags']) && !empty($requestArray['tags'])){
        //         $row->tags()->sync($requestArray['tags']);
        //    }
        $this->syncTagsSkills($row, $requestArray);
        return redirect()->route('videos.index');
    }
    // protected function filter($rows)
    // {
    //     if(request()->has('name') && request()->get('name') != "")
    //     $rows = $rows->where('name' , request()->get('name'));
    //     return $rows;

    // }
    public function update($id, Update $request)
    {

        $requestArray = $request->all();
        if ($request->hasFile('image')) {
            $filename = $this->uploadImage($request);
            $requestArray = ['image' => $filename] + $requestArray;
        }
        $row = $this->model->findOrFail($id);
        $row->update($requestArray);
        $this->syncTagsSkills($row, $requestArray);

        //return redirect()->route('users.index');
        return redirect()->route('videos.edit', $row->id);
    }
    protected function syncTagsSkills($row, $requestArray)
    {
        if (isset($requestArray['skills']) && !empty($requestArray['skills'])) {
            $row->skills()->sync($requestArray['skills']);
        }
        if (isset($requestArray['tags']) && !empty($requestArray['tags'])) {
            $row->tags()->sync($requestArray['tags']);
        }
    }
    protected function uploadImage($request)
    {

        $file = $request->file('image');
        $filename = time() . str_random(10) . '.' . $file->getClientOriginalExtension(); //i five the image randome name
        $file->move(public_path('uploads'), $filename);
        return $filename;
    }
}

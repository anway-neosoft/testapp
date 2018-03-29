<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $category){
        $this->category =$category;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data = $this->category->getListing($request->all());
        return view('category.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [''=>'select']+ $this->category->getDropDownList();
        return view('category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data= $request->except('_token');

        $result = $this->category->saveRecord($data);
        if($result){
            return redirect('categories');
        }else{
            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->category->find($id);
        return view('category.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = [''=>'select']+ $this->category->getDropDownList($id);
        $record = $this->category->find($id);
        return view('category.edit',compact('categories','record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data= $request->except(['_token','_method']);
        $result = $this->category->saveRecord($data,$id);
        if($result){
            return redirect('categories');
        }else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $record = $this->category->find($id);
         $result ='';
         $message = 'Error Ocured';
         if($record->children()->get()->count()){
            $message = 'Category cannot be deleted. Active subcategories are assigned to this category';
         }else{
            $result = $record->delete();
         }
        if($result){
            return redirect('categories')->with('message','Category Deleted Successfully')->with('class','success');
        }else{
            return redirect()->back()->with('message',$message)->with('class','danger');
        }
    }
}

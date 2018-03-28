<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user){
        $this->user =$user;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data = $this->user->getListing($request->all());
        return view('user.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userRequest $request)
    {
        $data= $request->except('_token');
        $result = $this->user->create($data);
        if($result){
            return redirect('users');
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
        $record = $this->user->find($id);
        return view('user.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->user->find($id);
        return view('user.edit',compact('users','record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userRequest $request, $id)
    {
        $data= $request->except(['_token','_method']);
        $result = $this->user->find($id)->update($data);
        if($result){
            return redirect('users');
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

         $message = 'Error Ocured';
         
        $result = $this->user->find($id)->delete();
        if($result){
            return redirect('users')->with('message','User Deleted Successfully')->with('class','success');
        }else{
            return redirect()->back()->with('message',$message)->with('class','danger');
        }
    }
}

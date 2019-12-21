<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\City;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Role::paginate(20);
        return view('role.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model=new Role();
        return view('role.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|unique:roles',
            'display_name'=>'required',
            'description'=>'required',

        ];
        $message=[
            'name.required'=>' the name is required'
        ];
        $this->validate($request,$rules,$message);
        $record=Role::create($request->all());
        $record->permissions()->attach($request->permissions_lists);
        flash()->success('success');
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=Role::findOrFail($id);
        return view('role.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'required|unique:roles,name,'.$id,
            'display_name'=>'required',
            'description'=>'required',

        ];
        $message=[
            'name.required'=>' the name is required'
        ];
        $this->validate($request,$rules,$message);



        $record=Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->Sync($request->permissions_lists);
        flash()->success('Edited');
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Role::findOrFail($id);
        $record->delete();
        flash()->success('deleted');
        return back();
    }
}

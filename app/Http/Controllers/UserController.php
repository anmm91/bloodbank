<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Array_;

class UserController extends Controller
{
    public function activation($id){
        $user=User::findOrfail($id);
        if(\auth('web')->user()->id == $user->id){


            flash()->error('you can not daactivate your self');
            return back();
        }
        if($user->is_active==1){
            $user->is_active=0;
            $user->save();

        }else{
            $user->is_active=1;
            $user->save();
        }
        flash()->success('success');
        return back();

    }
    public function indexPassword(){

        return view('reset.index');
    }
    public function reset(request $request){

        //validation
        $rules=[
            'old_password'=>'required',
            'new_password'=>'required|confirmed'
        ];
        $message=[
            'old_password.required'=>'القديم مطلوب',
            'new_password.required'=>'الجديد مطلوب'
        ];
        $this->validate($request,$rules,$message);

        $user=Auth::guard('web')->user();

        if(Hash::check($request->input('old_password'),$user->password)){

            $user->password = Hash::make($request->new_password);
            $user->save();

            flash()->success('password updated successfully');
            return back();
        }
        else{

            flash()->error('old password is wrong');
            return back();
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if(!auth()->user()->can('users-lists')){
//            abort(403);
//        }
        $records=User::paginate(10);
        return view('user.index',compact('records'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model=new User();
        return view('user.create',compact('model'));
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',


        ];
        $message=[
            'name.required'=>' the name is required'
        ];
        $this->validate($request,$rules,$message);

        $request->merge(['password'=>Hash::make($request->password)]);
        $record=User::create($request->all());
        $record->roles()->attach($request->roles_lists);
        flash()->success('success');
        return redirect(route('user.index'));
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
        $model=User::findOrFail($id);
        return view('user.edit',compact('model'));
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
        //validation
        $this->validate($request,[
            'name'=>'required|unique:users,name,'.$id,
            'email'=>'required',
            'password'=>'confirmed',
            'roles_lists'=>'required'
        ]);


        $record=User::findOrFail($id);
        $record->roles()->sync((Array)$request->input('roles_lists'));

        $update=$record->update($request->except('password'));
        if($request->has('password') && $request->password != null)
        {
            $record->password = Hash::make($request->password);
            $record->save();
        }

        flash()->success('Edited');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=User::findOrFail($id);
        $record->delete();
        flash()->success('deleted');
        return back();
    }
}

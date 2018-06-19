<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Http\Controllers\Controller;
use KTS\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:user-list', ['except' => ['edit','update']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','ASC')->paginate(50);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 50);
        return view('users.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $weekdays = config('app.weekdays');
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles','weekdays'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $weekdays = config('app.weekdays');

        return view('users.edit',compact('user','roles','userRole','weekdays'));
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
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
	        if(!empty($input['password'])){ 
	            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));

        if (!$user->hasPermissionTo('user-list')) {
        	return redirect()->route('users.edit', $user->id)
                        ->with('success','User updated successfully');
        }
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->active = 0; 
        $user->save(); 
        $user->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    /**
     * Ajax requests with different functions
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxAction(Request $request)
    {
        $id = $request->get('id'); 
        $action = $request->get('a');
        $user = User::find($id);
        $success = true; 
        if (!$user) {
            $success = false; 
            $message = 'User not found.'; 
        }  

        switch ($action) {
            case 'statupdate':
                $is_checked = $request->get('checked'); 
                $user->active = $is_checked;
                $user->save(); 
                $message = 'User status was successfully updated.'; 
                break;
            
            default:
                $message = 'No action needed.';
                break;
        }

        return response()->json([ 'result'=>$success, 'message'=>$message ]);
    }
}

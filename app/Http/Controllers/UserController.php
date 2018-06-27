<?php

namespace KTS\Http\Controllers;

use Illuminate\Http\Request;
use KTS\Http\Controllers\Controller;
use KTS\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use DB;
use Hash;
use Auth; 
use Image; 

class UserController extends Controller
{
    /**
     * check if the logged user has permission
     *
     * @return \Illuminate\Http\Response
     */
    private function checkAccess($permission) 
    {
        $loggedUser = Auth::user(); 
        if (!$loggedUser->can($permission)) 
            abort(403, 'Unauthorized action.');
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $this->checkAccess('user-list'); 

        $data = User::orderBy('id','ASC')->get();
        return view('users.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkAccess('user-create'); 

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
        $this->checkAccess('user-create'); 

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
        $this->checkAccess('user-edit'); 
        $loggedUser = Auth::user(); 
        if (!$loggedUser->hasRole('Admin') && $loggedUser->id != $id) {
            abort(404, '404 Page not found.');
        }

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
        $this->checkAccess('user-edit'); 
        $loggedUser = Auth::user(); 
        

        if (!$loggedUser->hasRole('Admin') && $loggedUser->id != $id) {
            abort(404, '404 Page not found.');
        }

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $weekdays = config('app.weekdays');

        $backRedirect = ($loggedUser->hasRole('Admin')) ? route('users.index') : route('users.show', $loggedUser->id); 

        return view('users.edit',compact('user','roles','userRole','weekdays','backRedirect'));
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
        $this->checkAccess('user-edit'); 

        $fields = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'
        ];

        $loggedUser = Auth::user(); 
        if ($loggedUser->hasRole('Admin')) $fields['roles'] = 'required';

        $this->validate($request, $fields);

        $input = $request->all();
	        if(!empty($input['password'])){ 
	            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);

        if ($loggedUser->hasRole('Admin')) {
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));

            return redirect()->route('users.index')
                        ->with('success','User updated successfully.');
        }
        
        return redirect()->route('users.show', $user->id)
                        ->with('success','User updated successfully.');
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkAccess('user-delete'); 

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
        $this->checkAccess('user-change-status');

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

    /**
     * Show the form for editing the specified resource' profile picture.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadProfileImg(Request $request)
    {
        DB::beginTransaction(); 
        $valid = $request->validate([
            'avatar' => 'image',
            'id' => 'required'
        ]);
        if (!$valid) return $valid; 

        $id = $request->get('id'); 
        if(!$id) abort(404, 'Page not found.');

        $user = User::find($id);
        $file = $request->file('avatar'); 
        $now = time(); 

        if ($user && $file) {
            $extension = '.'.$file->getClientOriginalExtension(); 
            $folder = 'public'; $sub_folder = 'avatars/usr-'.$user->id;
            $destination_path = $folder.'/'.$sub_folder; 
            //create the thumbnail
            $img = Image::make($file);
            $img->resize(128, 128, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::put($destination_path.'/thumb-'.$now.$extension, $img->encode());

            //create profile image
            $img = Image::make($file);
            $img->resize(220, 220, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $uploaded = Storage::put($destination_path.'/avatar-'.$now.$extension, $img->encode());
            // Storage::putFileAs(
            //     'public/avatars/usr-'.$user->id, $file, 'avatar-'.$now.$extension
            // );
            if ($uploaded) {
                $user->profile_img = $sub_folder.'/avatar-'.$now.$extension; 
                $user->save(); 
            }
        }
        DB::commit(); 
        return response()->json([ 'avatar'=> $user->getAvatar(), 'thumb'=> $user->getThumbnail() ]); 
    }
}

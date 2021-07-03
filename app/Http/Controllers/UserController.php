<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AclRoleInfo;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::where('is_active', '!=', 0)->get();
        return view('user.user_list', compact('users'));
    }

    public function create()
    {
        $role_info = AclRoleInfo::where('is_active', '!=', 0)->get();

        return view('user.user_add', compact('role_info'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|unique:users|max:255',
            'role_id'  => 'required',
            'password' => 'required|min:8',
        ]);

        $user_info = new User();

        $user_info->name       = $request->name;
        $user_info->email      = $request->email;
        $user_info->role_id    = $request->role_id;
        $user_info->is_active  = $request->is_active;
        $user_info->password   = Hash::make($request->password);
        $user_info->created_by = Auth::user()->id;
        $user_info->created_ip = request()->ip();
        $user_info->created_at = date('Y-m-d H:i:s');

        $data_save = $user_info->save();

        if($data_save){
              return redirect()->route('user.list')->with('message', 'Successfully Added');  
        }
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $user_info = User::find($id);
        $role_info = AclRoleInfo::where('is_active', '!=', 0)->get();

        return view('user.user_edit', compact('user_info', 'role_info'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|max:255',
        ]);

        $user_info = User::find($id);

        $user_info->name       = $request->name;
        $user_info->email      = $request->email;
        $user_info->role_id    = $request->role_id;
        $user_info->is_active  = $request->is_active;
        $user_info->password   = isset($request->password) ? Hash::make($request->password) : $request->pre_password;
        $user_info->updated_by = Auth::user()->id;
        $user_info->updated_ip = request()->ip();
        $user_info->updated_at = date('Y-m-d H:i:s');

        $data_save = $user_info->save();

        if($data_save){
              return redirect()->route('user.list')->with('message', 'Successfully Updated');  
        }
    }

    public function destroy($id)
    {
        $user_info = User::find($id);

        $user_info->is_active  = 0;
        $user_info->updated_by = Auth::user()->id;
        $user_info->updated_ip = request()->ip();
        $user_info->updated_at = date('Y-m-d H:i:s');

        $data_save = $user_info->save();

        if($data_save){
              return redirect()->route('user.list')->with('message', 'Successfully Delete');  
        }
    }

    public function change_password()
    {
        return view('user.change_password');
    }

    public function change_password_store(Request $request){

        $id = Auth::user()->id;
        $user_info = User::find($id);

        $user_info->password   = isset($request->password) ? Hash::make($request->password) : $request->pre_password;
        $user_info->updated_by = Auth::user()->id;
        $user_info->updated_ip = request()->ip();
        $user_info->updated_at = date('Y-m-d H:i:s');

        $data_save = $user_info->save();

        if($data_save){
              return redirect()->route('user.change_password')->with('message', 'Successfully Password Changed');  
        }
    }
}

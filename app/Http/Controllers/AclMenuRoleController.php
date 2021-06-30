<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AclMenuInfo;
use App\Models\AclRoleInfo;
use DB;

class AclMenuRoleController extends Controller
{
    
    public function index()
    {
        $menu_info = AclMenuInfo::where('is_active', '!=', 0)->get();
        return view('user.menu.list', compact('menu_info'));

    }

    public function create()
    {
        $get_menu_info = AclMenuInfo::where('is_active', '!=', 0)->get();
        return view('user.menu.create', compact('get_menu_info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu_info = new AclMenuInfo();

        $menu_info->title            = $request->title;
        $menu_info->link             = $request->link;
        $menu_info->parent_id        = $request->parent_id;
        $menu_info->glyphicon_icon   = $request->glyphicon_icon;
        $menu_info->display_position = $request->display_position;
        $menu_info->is_main_menu     = $request->is_main_menu;
        $menu_info->is_active        = $request->is_active;
        $menu_info->created_by       = Auth::user()->id;
        $menu_info->created_ip       = request()->ip();
        $menu_info->created_at       = date('Y-m-d H:i:s');

        $data_save = $menu_info->save();

        if($data_save){
              return redirect()->route('menu.list')->with('message', 'Successfully Added');  
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $menu_info = AclMenuInfo::find($id);
        $get_menu_info = AclMenuInfo::where('is_active', '!=', 0)->get();

        return view('user.menu.edit', compact('menu_info','get_menu_info'));
    }

    
    public function update(Request $request, $id)
    {
        $menu_info =  AclMenuInfo::find($id);

        $menu_info->title            = $request->title;
        $menu_info->link             = $request->link;
        $menu_info->parent_id        = $request->parent_id;
        $menu_info->glyphicon_icon   = $request->glyphicon_icon;
        $menu_info->display_position = $request->display_position;
        $menu_info->is_main_menu     = $request->is_main_menu;
        $menu_info->is_active        = $request->is_active;
        $menu_info->updated_by       = Auth::user()->id;
        $menu_info->updated_ip       = request()->ip();
        $menu_info->updated_at       = date('Y-m-d H:i:s');

        $data_save = $menu_info->save();

        if($data_save){
              return redirect()->route('menu.list')->with('message', 'Successfully Updated');  
        }
    }

    public function destroy($id)
    {
        $menu_info =  AclMenuInfo::find($id);

        $menu_info->is_active        = 0;
        $menu_info->updated_by       = Auth::user()->id;
        $menu_info->updated_ip       = request()->ip();
        $menu_info->updated_at       = date('Y-m-d H:i:s');

        $data_delete = $menu_info->save();

        if($data_delete){
              return redirect()->route('menu.list')->with('message', 'Successfully Delete');  
        }
    }

    public function role_list()
    {
        $role_info = AclRoleInfo::where('is_active', '!=', 0)->get();
        
        return view('user.role.list', compact('role_info'));

    }

    public function role_create()
    {
        $get_menu_info = AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>1])->get();
       
        if(!empty($get_menu_info)){
            foreach($get_menu_info as $key=> $mainMenu){
                // dd($mainMenu->id);
               $get_menu_info[$key]['mainChild']= AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>2,'parent_id'=> $mainMenu->id])->get();
            }
        }
      //  dd($get_menu_info);
        return view('user.role.create', compact('get_menu_info'));
    }

    public function role_store(Request $request){

        $role_info =  $request->role_info;
        //dd($role_info);
    
        $role_data = [
            'role_name'   => $request->role_name,
            'role_info'   => (!empty($role_info)? json_encode($role_info,JSON_NUMERIC_CHECK):NULL),
            'is_active'   => $request->is_active,
            'created_by'  => Auth::user()->id,
            'created_ip'  => request()->ip(),
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('acl_role_info')->insert($role_data);

        if($data_save){
              return redirect()->route('role.list')->with('message', 'Successfully Save');  
        }
    }

    public function role_edit($id)
    {
        $get_role_info = AclRoleInfo::where(['is_active'=> 1, 'id'=> $id,])->first();
        $role_data = json_decode($get_role_info->role_info);
       
        $get_menu_info = AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>1])->get();
       
        if(!empty($get_menu_info)){
            foreach($get_menu_info as $key=> $mainMenu){
               $get_menu_info[$key]['mainChild']= AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>2,'parent_id'=> $mainMenu->id])->get();
            }
        }


        // foreach($get_menu_info as  $item){
                    
        //             //echo "<pre>";  
        //            //print_r($role_data);        
        //         if(!empty($item->mainChild)){

        //             foreach($item->mainChild as $childKey => $row){
        //                 //echo "<pre>";   
        //                 //echo $row->title;    
        //             }    
        //         }
        // }

        // echo "<pre>";
        // print_r($role_data);
        // exit;
      
        return view('user.role.edit', compact('get_menu_info', 'get_role_info', 'role_data'));
    }

}

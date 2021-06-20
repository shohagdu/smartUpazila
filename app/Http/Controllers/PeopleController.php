<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\People;
use DataTables;
use Session;
use DB;

class PeopleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $people_info = People::where('is_active', '!=', 0)->get();

        return view('people.people', compact('people_info'));
    }


    public function create()
    {
        return view('people.people_create');
    }

   
    public function store(Request $request)
    {
        if(isset($request->image)){

            $imageName = 'people_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/people', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $people_info = [
            'name'         => $request->name,
            'mobile'       => $request->mobile,
            'email'        => $request->email,
            'address'      => $request->address,
            'details'      => $request->details,
            'type'         => $request->type,
            'period_start' => date('Y-m-d', strtotime($request->period_start)),
            'period_end'   => date('Y-m-d', strtotime($request->period_end)),
            'image'        => $image,
            'view_order'   => $request->view_order,
            'is_active'    => $request->is_active,
            'created_by'   => Auth::user()->id,
            'created_ip'   => request()->ip(),
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('people')->insert($people_info);

        if($data_save){
            
              return redirect()->route('people.index')->with('message', 'Successfully Save');  

        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $info = People::find($id);

        return view('people.people_edit', compact('info'));
    }

    public function update(Request $request, $id)
    {
        if(isset($request->image)){

            $imageName = 'people_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/people', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_image;
  
          }

        $people_info = [
            'name'         => $request->name,
            'mobile'       => $request->mobile,
            'email'        => $request->email,
            'address'      => $request->address,
            'details'      => $request->details,
            'type'         => $request->type,
            'period_start' => date('Y-m-d', strtotime($request->period_start)),
            'period_end'   => date('Y-m-d', strtotime($request->period_end)),
            'image'        => $image,
            'view_order'   => $request->view_order,
            'is_active'    => $request->is_active,
            'updated_by'   => Auth::user()->id,
            'updated_ip'   => request()->ip(),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('people')->where('id', '=', $id)->update($people_info);

        if($data_save){
            
              return redirect()->route('people.index')->with('message', 'Successfully Updated');  

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
        $people_info = [
            'is_active'    => 0,
            'updated_by'   => Auth::user()->id,
            'updated_ip'   => request()->ip(),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $data_delete = DB::table('people')->where('id', '=', $id)->update($people_info);

        if($data_delete){
            
              return redirect()->route('people.index')->with('message', 'Successfully Delete');  

        }
    }
}

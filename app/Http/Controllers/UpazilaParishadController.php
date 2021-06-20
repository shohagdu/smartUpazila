<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Upazila_basic_info;
use DataTables;
use Session;
use DB;

class UpazilaParishadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
         $if_exist_check_info = DB::table('upazila_basic_info')->where('upazila_chairman', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->upazila_chairman) ? json_decode($if_exist_check_info->upazila_chairman) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('upazila_parishad.upazila_chirman', compact('data'));
    }

    public function create()
    {
        return view('upazila_parishad.upazila_chirman_create');
    }

   
    public function store(Request $request)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('upazila_chairman', '!=', NULL)->first();

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($upazila_chairman_id > 0){

            $upazila_chairman_data_get = json_decode($if_exist_check_info->upazila_chairman);


            $id = count((array)$upazila_chairman_data_get)+1;

        }else{

            $id = 1;
        }


        if(isset($request->image)){

            $imageName = 'chairman_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/upazila_chairman', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'details'        => $request->details,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'upazila_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
      
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('upazila_parishad.upazila_chairman')->with('message', 'Successfully Save'); 
            }  


        }else{

            $upazila_chairman_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'upazila_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];


            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

           if($data_save){

            return redirect()->route('upazila_parishad.upazila_chairman')->with('message', 'Successfully Save');   

           }
        }


    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('upazila_chairman', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->upazila_chairman);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $chairman_data = array_values($info);

        return view('upazila_parishad.upazila_chirman_edit', compact('chairman_data'));
    }

    
    public function update(Request $request, $id)
    {
        $if_exist_check_info = DB::table('upazila_basic_info')->where('upazila_chairman', '!=', NULL)->first();

        $upazila_chairman_data_get = json_decode($if_exist_check_info->upazila_chairman);


        $key = array_search($id, array_column($upazila_chairman_data_get, 'id'));

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if(isset($request->image)){

            $imageName = 'chairman_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/upazila_chairman', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_img;
  
          }

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'details'        => $request->details,
            'is_active'      => $request->is_active,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'upazila_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
          
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.upazila_chairman')->with('message', 'Successfully Updated');   


        }     
    
    }

   
    public function destroy($id)
    {
        $if_exist_check_info = DB::table('upazila_basic_info')->where('upazila_chairman', '!=', NULL)->first();

        $upazila_chairman_data_get = json_decode($if_exist_check_info->upazila_chairman);

        $info = array_filter($upazila_chairman_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $chairman_data = array_values($info);

        $key = array_search($id, array_column($upazila_chairman_data_get, 'id'));

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $chairman_data[0]->name,
            'mobile'         => $chairman_data[0]->mobile,
            'email'          => $chairman_data[0]->email,
            'period_start'   => date('Y-m-d', strtotime($chairman_data[0]->period_start)),
            'period_end'     => date('Y-m-d', strtotime($chairman_data[0]->period_end)),
            'image'          => $chairman_data[0]->image,
            'view_order'     => $chairman_data[0]->view_order,
            'details'        => $chairman_data[0]->details,
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

          

        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'upazila_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
            
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.upazila_chairman')->with('message', 'Successfully Delete');   


        }
    }

    // vice chairman

    public function vice_chairman(Request $request)
    {
         $if_exist_check_info = DB::table('upazila_basic_info')->where('vice_chariman', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->vice_chariman) ? json_decode($if_exist_check_info->vice_chariman) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('upazila_parishad.upazila_vice_chirman', compact('data'));
    }

    public function vice_chairman_create()
    {
        return view('upazila_parishad.upazila_vice_chirman_create');
    }

    public function vice_chairman_store(Request $request)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('vice_chariman', '!=', NULL)->first();

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($upazila_chairman_id > 0){

            $upazila_chairman_data_get = json_decode($if_exist_check_info->vice_chariman);


            $id = count((array)$upazila_chairman_data_get)+1;

        }else{

            $id = 1;
        }


        if(isset($request->image)){

            $imageName = 'vice_chairman_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/vice_chairman', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'details'        => $request->details,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'vice_chariman'   => (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.vice_chairman')->with('message', 'Successfully Save');   


        }else{

            $upazila_chairman_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'vice_chariman'   => (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.vice_chairman')->with('message', 'Successfully Save');   
        }

    }

    public function vice_chairman_edit($id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('vice_chariman', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->vice_chariman);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $chairman_data = array_values($info);

        return view('upazila_parishad.upazila_vice_chirman_edit', compact('chairman_data'));
    }

    public function vice_chairman_update(Request $request, $id)
    {
        $if_exist_check_info = DB::table('upazila_basic_info')->where('vice_chariman', '!=', NULL)->first();

        $upazila_chairman_data_get = json_decode($if_exist_check_info->vice_chariman);


        $key = array_search($id, array_column($upazila_chairman_data_get, 'id'));

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if(isset($request->image)){

            $imageName = 'vice_chairman_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/vice_chairman', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_img;
  
          }

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'details'        => $request->details,
            'is_active'      => $request->is_active,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'vice_chariman'   => (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.vice_chairman')->with('message', 'Successfully Updated');   


        }     
    }


    public function vice_chairman_delete($id)
    {
        $if_exist_check_info = DB::table('upazila_basic_info')->where('vice_chariman', '!=', NULL)->first();

        $upazila_chairman_data_get = json_decode($if_exist_check_info->vice_chariman);

        $info = array_filter($upazila_chairman_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $chairman_data = array_values($info);

        $key = array_search($id, array_column($upazila_chairman_data_get, 'id'));

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $chairman_data[0]->name,
            'mobile'         => $chairman_data[0]->mobile,
            'email'          => $chairman_data[0]->email,
            'period_start'   => date('Y-m-d', strtotime($chairman_data[0]->period_start)),
            'period_end'     => date('Y-m-d', strtotime($chairman_data[0]->period_end)),
            'image'          => $chairman_data[0]->image,
            'view_order'     => $chairman_data[0]->view_order,
            'details'        => $chairman_data[0]->details,
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'vice_chariman'   => (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.vice_chairman')->with('message', 'Successfully Delete');   


        }
    }

    // parisad kajjboli

    public function parisad_kajjoboli(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('parisad_kajjoboli', '!=', NULL)->first();


        if($request->ajax()){
           $informations = !empty($if_exist_check_info->parisad_kajjoboli) ? json_decode($if_exist_check_info->parisad_kajjoboli) : [];

            $data = array_filter($informations, function($data){
                return $data->is_active != 0;
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('is_active',function($row){
                    $html = '';

                    if($row->is_active == 1){
                        $html.='<span class="label label-info"> Active </span>';
                    }elseif($row->is_active == 2){

                        $html.='<span class="label label-warning"> Inactive </span>';
                    }


                    return $html;
                })
                ->addColumn('action',function($row){
                    $html = '';

                        $html.='<button class="btn btn-primary btn-xs parsadKajjaboliEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs parisadKajjaboliDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>';

                    return $html;
                })
                ->rawColumns(['is_active','action'])
                ->make(true);
        }else{

        return view('upazila_parishad.parisad_kajjoboli');
        }

    }
    public function parisad_kajjoboli_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('parisad_kajjoboli', '!=', NULL)->first();

        $parisad_kajjoboli_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;
        

        if ($parisad_kajjoboli_id > 0){

            $parisad_kajjoboli_data_get = json_decode($if_exist_check_info->parisad_kajjoboli);


            $id = count((array)$parisad_kajjoboli_data_get)+1;

        }else{

            $id = 1;
        }

        $parisad_kajjoboli_info = [
            'id'                => $id,
            'office'            => $request->office,
            'message'           => $request->message,
            'display_position' => $request->display_position,
            'is_active'        => $request->is_active,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];



        if (!empty($parisad_kajjoboli_data_get)){
            $parisad_kajjoboli_data_get[] = $parisad_kajjoboli_info;

            $upazila_basic_info_data = [
                'parisad_kajjoboli'=> (!empty($parisad_kajjoboli_data_get)? json_encode($parisad_kajjoboli_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'created_ip'  => request()->ip(),
                'created_at'   => date('Y-m-d H:i:s'),
            ];
           
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $parisad_kajjoboli_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);


        }else{
            $parisad_kajjoboli_data_get[] = $parisad_kajjoboli_info;

            $upazila_basic_info_data = [
                'parisad_kajjoboli'=> (!empty($parisad_kajjoboli_data_get)? json_encode($parisad_kajjoboli_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'created_ip'  => request()->ip(),
                'created_at'   => date('Y-m-d H:i:s'),
            ];
            

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }

    }

    public function parisad_kajjoboli_edit(Request $request)
    {
        $if_exist_check_info = Upazila_basic_info::where('parisad_kajjoboli', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->parisad_kajjoboli);

        $info = array_filter($informations, function($info) use($request){
            return $info->id == $request->id;
        });

        return response()->json([
            'status' => !empty($info) ? 'success' : 'error',
            'msg'    => !empty($info) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($info) ? array_values($info) : []
        ]);
    }

    public function parisad_kajjoboli_update(Request $request)
    {

        $id = $request->kajjaboli_id;

        $if_exist_check_info = Upazila_basic_info::where('parisad_kajjoboli', '!=', NULL)->first();

        $parisad_kajjoboli_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $parisad_kajjoboli_data_get = json_decode($if_exist_check_info->parisad_kajjoboli);

        $key = array_search($request->kajjaboli_id, array_column($parisad_kajjoboli_data_get, 'id'));

        

        $parisad_kajjoboli_info = [
            'id'                => $id,
            'office'            => $request->office,
            'message'           => $request->message,
            'display_position' => $request->display_position,
            'is_active'        => $request->is_active,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];



        if (!empty($parisad_kajjoboli_data_get)){

            $parisad_kajjoboli_data_get[$key] = $parisad_kajjoboli_info;

            $upazila_basic_info_data = [
                'parisad_kajjoboli'=> (!empty($parisad_kajjoboli_data_get)? json_encode($parisad_kajjoboli_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'created_ip'  => request()->ip(),
                'created_at'   => date('Y-m-d H:i:s'),
            ];
           
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $parisad_kajjoboli_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Updated' : 'Someting went wrong',
            ]);


        }

    }

    public function parisad_kajjoboli_destroy(Request $request)
    {


        $if_exist_check_info = Upazila_basic_info::where('parisad_kajjoboli', '!=', NULL)->first();

        $parisad_kajjoboli_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $parisad_kajjoboli_data_get = json_decode($if_exist_check_info->parisad_kajjoboli);


        $id = $request->id;

        $info = array_filter($parisad_kajjoboli_data_get, function($info) use($id){
            return $info->id == $id;
        });


         $parisad_kajjoboli_data_info = array_values($info);


        $key = array_search($request->id, array_column($parisad_kajjoboli_data_get, 'id'));

        

        $parisad_kajjoboli_info = [
            'id'               => $id,
            'office'           => $parisad_kajjoboli_data_info[0]->office,
            'message'          => $parisad_kajjoboli_data_info[0]->message,
            'display_position' => $parisad_kajjoboli_data_info[0]->display_position,
            'is_active'        => 0,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];



        if (!empty($parisad_kajjoboli_data_get)){

            $parisad_kajjoboli_data_get[$key] = $parisad_kajjoboli_info;

            $upazila_basic_info_data = [
                'parisad_kajjoboli'=> (!empty($parisad_kajjoboli_data_get)? json_encode($parisad_kajjoboli_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'created_ip'  => request()->ip(),
                'created_at'   => date('Y-m-d H:i:s'),
            ];
           
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $parisad_kajjoboli_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Deleted' : 'Someting went wrong',
            ]);


        }

    }

    // female vice chairman

    public function female_vice_chairman(Request $request)
    {
         $if_exist_check_info = DB::table('upazila_basic_info')->where('female_vice_chairman', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->female_vice_chairman) ? json_decode($if_exist_check_info->female_vice_chairman) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('upazila_parishad.upazila_female_vice_chirman', compact('data'));
    }

    public function female_vice_chairman_create()
    {
        return view('upazila_parishad.upazila_female_vice_chirman_create');
    }

    public function female_vice_chairman_store(Request $request)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('female_vice_chairman', '!=', NULL)->first();

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($upazila_chairman_id > 0){

            $upazila_chairman_data_get = json_decode($if_exist_check_info->female_vice_chairman);


            $id = count((array)$upazila_chairman_data_get)+1;

        }else{

            $id = 1;
        }


        if(isset($request->image)){

            $imageName = 'female_vice_chairman_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/female_vice_chairman', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'details'        => $request->details,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'female_vice_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.female_vice_chairman')->with('message', 'Successfully Save');   


        }else{

            $upazila_chairman_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'female_vice_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.female_vice_chairman')->with('message', 'Successfully Save');   
        }

    }

    public function female_vice_chairman_edit($id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('female_vice_chairman', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->female_vice_chairman);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $chairman_data = array_values($info);

        return view('upazila_parishad.upazila_female_vice_chirman_edit', compact('chairman_data'));
    }

    public function female_vice_chairman_update(Request $request, $id)
    {
        $if_exist_check_info = DB::table('upazila_basic_info')->where('female_vice_chairman', '!=', NULL)->first();

        $upazila_chairman_data_get = json_decode($if_exist_check_info->female_vice_chairman);


        $key = array_search($id, array_column($upazila_chairman_data_get, 'id'));

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if(isset($request->image)){

            $imageName = 'female_vice_chairman_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/female_vice_chairman', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_img;
  
          }

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'details'        => $request->details,
            'is_active'      => $request->is_active,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'female_vice_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
     
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.female_vice_chairman')->with('message', 'Successfully Updated');   


        }     
    }


    public function female_vice_chairman_delete($id)
    {
        $if_exist_check_info = DB::table('upazila_basic_info')->where('female_vice_chairman', '!=', NULL)->first();

        $upazila_chairman_data_get = json_decode($if_exist_check_info->female_vice_chairman);

        $info = array_filter($upazila_chairman_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $chairman_data = array_values($info);

        $key = array_search($id, array_column($upazila_chairman_data_get, 'id'));

        $upazila_chairman_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $chairman_data[0]->name,
            'mobile'         => $chairman_data[0]->mobile,
            'email'          => $chairman_data[0]->email,
            'period_start'   => date('Y-m-d', strtotime($chairman_data[0]->period_start)),
            'period_end'     => date('Y-m-d', strtotime($chairman_data[0]->period_end)),
            'image'          => $chairman_data[0]->image,
            'view_order'     => $chairman_data[0]->view_order,
            'details'        => $chairman_data[0]->details,
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        if (!empty($upazila_chairman_data_get)){
            $upazila_chairman_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'female_vice_chairman'=> (!empty($upazila_chairman_data_get)? json_encode($upazila_chairman_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $upazila_chairman_id)->update($upazila_basic_info_data);

            return redirect()->route('upazila_parishad.female_vice_chairman')->with('message', 'Successfully Delete');   


        }
    }


}

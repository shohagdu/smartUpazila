<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AllTypeTitle;
use App\Models\Upazila_basic_info;
use DataTables;
use Session;
use DB;


class PourosovaRelatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('pourosova_at_glance', '!=', NULL)->first();


        if($request->ajax()){
           $informations = !empty($if_exist_check_info->pourosova_at_glance) ? json_decode($if_exist_check_info->pourosova_at_glance) : [];

            $data = array_filter($informations, function($data){
                return $data->is_active != 0;
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title',function($row){
                    return AllTypeTitle::find($row->title)->title;
                 })
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

                        $html.='<button class="btn btn-primary btn-xs introDuceEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs UpIntrouduceDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>';

                    return $html;
                })
                ->rawColumns(['title','is_active','action'])
                ->make(true);
        }else{

               $all_type_info = AllTypeTitle::where('is_active','!=', 0)
                                    ->where('type','=',2)
                                    ->get();

        return view('pourosova_related.pourosova_at_glance', compact('all_type_info'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $if_exist_check_info = Upazila_basic_info::where('pourosova_at_glance', '!=', NULL)->first();

        // dd($if_exist_check_info);
         $pourosova_at_glance_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;
 
 
         if ($pourosova_at_glance_id > 0){
 
             $pourosova_at_glance_data_get = json_decode($if_exist_check_info->pourosova_at_glance);
 
 
             $id = count((array)$pourosova_at_glance_data_get)+1;
 
         }else{
 
             $id = 1;
         }
 
         $pourosova_at_glance_info = [
             'id'               => $id,
             'title'            => $request->title,
             'description'      => $request->description,
             'display_position' => $request->display_position,
             'is_active'        => $request->is_active,
             'created_by'       => Auth::user()->id,
             'created_ip'       => request()->ip(),
             'created_at'       => date('Y-m-d H:i:s'),
         ];
 
 
 
        // dd($upazila_basic_info_data);
 
         if (!empty($pourosova_at_glance_data_get)){
             $pourosova_at_glance_data_get[] = $pourosova_at_glance_info;
 
             $upazila_basic_info_data = [
                 'pourosova_at_glance'=> (!empty($pourosova_at_glance_data_get)? json_encode($pourosova_at_glance_data_get, JSON_UNESCAPED_UNICODE):NULL),
                 'is_active'   => $request->is_active,
                 'created_by'  => Auth::user()->id,
                 'created_ip'  => request()->ip(),
                 'created_at'   => date('Y-m-d H:i:s'),
             ];
             ////dd($upazila_basic_info_data);
             $data_save = DB::table('upazila_basic_info')->where('id', '=', $pourosova_at_glance_id)->update($upazila_basic_info_data);
 
             return response()->json([
                 'status' => $data_save ? 'success' : 'error',
                 'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
             ]);
 
 
         }else{
             $pourosova_at_glance_data_get[] = $pourosova_at_glance_info;
 
             $upazila_basic_info_data = [
                 'pourosova_at_glance'=> (!empty($pourosova_at_glance_data_get)? json_encode($pourosova_at_glance_data_get, JSON_UNESCAPED_UNICODE):NULL),
                 'is_active'   => $request->is_active,
                 'created_by'  => Auth::user()->id,
                 'created_ip'  => request()->ip(),
                 'created_at'   => date('Y-m-d H:i:s'),
             ];
            //dd($upazila_basic_info_data);
             $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);
             return response()->json([
                 'status' => $data_save ? 'success' : 'error',
                 'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
             ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $if_exist_check_info = Upazila_basic_info::where('pourosova_at_glance', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->pourosova_at_glance);

        $info = array_filter($informations, function($info) use($request){
            return $info->id == $request->id;
        });


        return response()->json([
            'status' => !empty($info) ? 'success' : 'error',
            'msg'    => !empty($info) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($info) ? array_values($info) : []
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->pourosova_at_glance_id;

        $if_exist_check_info = Upazila_basic_info::where('pourosova_at_glance', '!=', NULL)->first();

        // dd($if_exist_check_info);
         $pourosova_at_glance_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;
 
 
         $pourosova_at_glance_data_get = json_decode($if_exist_check_info->pourosova_at_glance);
        
         $key = array_search($request->pourosova_at_glance_id, array_column($pourosova_at_glance_data_get, 'id'));
 
         $pourosova_at_glance_info = [
             'id'               => $id,
             'title'            => $request->title,
             'description'      => $request->description,
             'display_position' => $request->display_position,
             'is_active'        => $request->is_active,
             'created_by'       => Auth::user()->id,
             'created_ip'       => request()->ip(),
             'created_at'       => date('Y-m-d H:i:s'),
         ];
 
 
 
        // dd($upazila_basic_info_data);
 
         if (!empty($pourosova_at_glance_data_get)){
             $pourosova_at_glance_data_get[$key] = $pourosova_at_glance_info;
 
             $upazila_basic_info_data = [
                 'pourosova_at_glance'=> (!empty($pourosova_at_glance_data_get)? json_encode($pourosova_at_glance_data_get, JSON_UNESCAPED_UNICODE):NULL),
                 'is_active'   => $request->is_active,
                 'created_by'  => Auth::user()->id,
                 'created_ip'  => request()->ip(),
                 'created_at'   => date('Y-m-d H:i:s'),
             ];
             ////dd($upazila_basic_info_data);
             $data_save = DB::table('upazila_basic_info')->where('id', '=', $pourosova_at_glance_id)->update($upazila_basic_info_data);
 
             return response()->json([
                 'status' => $data_save ? 'success' : 'error',
                 'msg'    => $data_save ? 'Successfully Updated' : 'Someting went wrong',
             ]);
 
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('pourosova_at_glance', '!=', NULL)->first();

         $pourosova_at_glance_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;
 
 
         $pourosova_at_glance_data_get = json_decode($if_exist_check_info->pourosova_at_glance);
        
         $key = array_search($request->id, array_column($pourosova_at_glance_data_get, 'id'));
 
         $pourosova_at_glance_info = [
             'id'               => $request->id,
             'title'            => $pourosova_at_glance_data_get[0]->title,
             'description'      => $pourosova_at_glance_data_get[0]->description,
             'display_position' => $pourosova_at_glance_data_get[0]->display_position,
             'is_active'        => 0,
             'created_by'       => Auth::user()->id,
             'created_ip'       => request()->ip(),
             'created_at'       => date('Y-m-d H:i:s'),
         ];
 
        //  dd($pourosova_at_glance_info);
 
         if (!empty($pourosova_at_glance_data_get)){
             $pourosova_at_glance_data_get[$key] = $pourosova_at_glance_info;
 
             $upazila_basic_info_data = [
                 'pourosova_at_glance'=> (!empty($pourosova_at_glance_data_get)? json_encode($pourosova_at_glance_data_get, JSON_UNESCAPED_UNICODE):NULL),
                 'is_active'   => 1,
                 'created_by'  => Auth::user()->id,
                 'created_ip'  => request()->ip(),
                 'created_at'   => date('Y-m-d H:i:s'),
             ];
             //dd($upazila_basic_info_data);
             $data_save = DB::table('upazila_basic_info')->where('id', '=', $pourosova_at_glance_id)->update($upazila_basic_info_data);
 
             return response()->json([
                 'status' => $data_save ? 'success' : 'error',
                 'msg'    => $data_save ? 'Successfully Deleted' : 'Someting went wrong',
             ]);
 
         }
    }

    public function pourosova_mayor(Request $request)
    {
         $if_exist_check_info = Upazila_basic_info::where('mayor', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->mayor) ? json_decode($if_exist_check_info->mayor) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('pourosova_related.pourosova_mayor', compact('data'));
    }

    public function pourosova_mayor_create()
    {
        return view('pourosova_related.pourosova_mayor_create');
    }

    public function pourosova_mayor_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('mayor', '!=', NULL)->first();

        $mayor_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($mayor_id > 0){

            $mayor_data_get = json_decode($if_exist_check_info->mayor);


            $id = count((array)$mayor_data_get)+1;

        }else{

            $id = 1;
        }


        if(isset($request->image)){

            $imageName = 'mayor_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/mayor', $imageName);
  
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


        if (!empty($mayor_data_get)){

            $mayor_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $mayor_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('pourosova_related.pourosova_mayor')->with('message', 'Successfully Save');   
            }



        }else{

            $mayor_data_get[] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            if($data_save){
                
                  return redirect()->route('pourosova_related.pourosova_mayor')->with('message', 'Successfully Save');  

            }
        }
    }

    
    public function pourosova_mayor_edit($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('mayor', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->mayor);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $mayor_data = array_values($info);

        return view('pourosova_related.pourosova_mayor_edit', compact('mayor_data'));
    }

    public function pourosova_mayor_update(Request $request, $id)
    {

        $if_exist_check_info = Upazila_basic_info::where('mayor', '!=', NULL)->first();

        $mayor_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $mayor_data_get = json_decode($if_exist_check_info->mayor);

        $key = array_search($id, array_column($mayor_data_get, 'id'));

        if(isset($request->image)){

            $imageName = 'mayor_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/mayor', $imageName);
  
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
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($mayor_data_get)){

            $mayor_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $mayor_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('pourosova_related.pourosova_mayor')->with('message', 'Successfully Updated');   
            }

        }
    }

    public function pourosova_mayor_delete($id){

        $if_exist_check_info = Upazila_basic_info::where('mayor', '!=', NULL)->first();

        $mayor_data_get = json_decode($if_exist_check_info->mayor);

        $info = array_filter($mayor_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $mayor_data = array_values($info);

        $key = array_search($id, array_column($mayor_data_get, 'id'));

        $mayor_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        $upazila_chairman_info = [
            'id'             => $id,
            'name'           => $mayor_data[0]->name,
            'mobile'         => $mayor_data[0]->mobile,
            'email'          => $mayor_data[0]->email,
            'period_start'   => date('Y-m-d', strtotime($mayor_data[0]->period_start)),
            'period_end'     => date('Y-m-d', strtotime($mayor_data[0]->period_end)),
            'image'          => $mayor_data[0]->image,
            'view_order'     => $mayor_data[0]->view_order,
            'details'        => $mayor_data[0]->details,
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($mayor_data_get)){

            $mayor_data_get[$key] = $upazila_chairman_info;

            $upazila_basic_info_data = [
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $mayor_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_mayor')->with('message', 'Successfully Deleted');   
            }

        }
    }

    // Councilor

    public function pourosova_councilor(Request $request)
    {
         $if_exist_check_info = Upazila_basic_info::where('councilor', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->councilor) ? json_decode($if_exist_check_info->councilor) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('pourosova_related.pourosova_councilor', compact('data'));
    }

    public function pourosova_councilor_create()
    {
        return view('pourosova_related.pourosova_councilor_create');
    }

    public function pourosova_councilor_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('councilor', '!=', NULL)->first();

        $councilor_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($councilor_id > 0){

            $councilor_data_get = json_decode($if_exist_check_info->councilor);


            $id = count((array)$councilor_data_get)+1;

        }else{

            $id = 1;
        }


        if(isset($request->image)){

            $imageName = 'councilor_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/councilor', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $upazila_councilor_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'ward_no'        => $request->ward_no,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($councilor_data_get)){

            $councilor_data_get[] = $upazila_councilor_info;

            $upazila_basic_info_data = [
                'councilor'       => (!empty($councilor_data_get)? json_encode($councilor_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $councilor_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_councilor')->with('message', 'Successfully Save');   
            }



        }else{

            $councilor_data_get[] = $upazila_councilor_info;

            $upazila_basic_info_data = [
                'councilor'       => (!empty($councilor_data_get)? json_encode($councilor_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            if($data_save){
                
                  return redirect()->route('pourosova_related.pourosova_councilor')->with('message', 'Successfully Save');  

            }
        }
    }

    public function pourosova_councilor_edit($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('councilor', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->councilor);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $councilor_data = array_values($info);

        return view('pourosova_related.pourosova_councilor_edit', compact('councilor_data'));
    }

    public function pourosova_councilor_update(Request $request, $id)
    {

        $if_exist_check_info = Upazila_basic_info::where('councilor', '!=', NULL)->first();

        $councilor_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $councilor_data_get = json_decode($if_exist_check_info->councilor);

        $key = array_search($id, array_column($councilor_data_get, 'id'));

        if(isset($request->image)){

            $imageName = 'councilor_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/councilor', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_img;
  
          }

        $upazila_councilor_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'period_start'   => date('Y-m-d', strtotime($request->period_start)),
            'period_end'     => date('Y-m-d', strtotime($request->period_end)),
            'image'          => $image,
            'view_order'     => $request->view_order,
            'ward_no'        => $request->ward_no,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        if (!empty($councilor_data_get)){

            $councilor_data_get[$key] = $upazila_councilor_info;

            $upazila_basic_info_data = [
                'councilor'       => (!empty($councilor_data_get)? json_encode($councilor_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $councilor_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_councilor')->with('message', 'Successfully Updated');   
            }

        }
    }

    public function pourosova_councilor_delete($id){

        $if_exist_check_info = Upazila_basic_info::where('councilor', '!=', NULL)->first();

        $councilor_data_get = json_decode($if_exist_check_info->councilor);

        $info = array_filter($councilor_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $councilor_data = array_values($info);

        $key = array_search($id, array_column($councilor_data_get, 'id'));

        $councilor_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        $upazila_councilor_info = [
            'id'             => $id,
            'name'           => $councilor_data[0]->name,
            'mobile'         => $councilor_data[0]->mobile,
            'email'          => $councilor_data[0]->email,
            'period_start'   => date('Y-m-d', strtotime($councilor_data[0]->period_start)),
            'period_end'     => date('Y-m-d', strtotime($councilor_data[0]->period_end)),
            'image'          => $councilor_data[0]->image,
            'view_order'     => $councilor_data[0]->view_order,
            'ward_no'        => $councilor_data[0]->ward_no,
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($councilor_data_get)){

            $councilor_data_get[$key] = $upazila_councilor_info;

            $upazila_basic_info_data = [
                'councilor'       => (!empty($councilor_data_get)? json_encode($councilor_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $councilor_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_councilor')->with('message', 'Successfully Deleted');   
            }

        }
    }
   
    // kormocari
    public function pourosova_kormocari(Request $request)
    {
         $if_exist_check_info = Upazila_basic_info::where('kormocari', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->kormocari) ? json_decode($if_exist_check_info->kormocari) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('pourosova_related.pourosova_kormocari', compact('data'));
    }

    public function pourosova_kormocari_create()
    {
        return view('pourosova_related.pourosova_kormocari_create');
    }

    public function pourosova_kormocari_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormocari', '!=', NULL)->first();

        $kormocari_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($kormocari_id > 0){

            $kormocari_data_get = json_decode($if_exist_check_info->kormocari);


            $id = count((array)$kormocari_data_get)+1;

        }else{

            $id = 1;
        }


        $upazila_kormocari_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'view_order'     => $request->view_order,
            'designation'    => $request->designation,
            'responsibilities'=> $request->responsibilities,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($kormocari_data_get)){

            $kormocari_data_get[] = $upazila_kormocari_info;

            $upazila_basic_info_data = [
                'kormocari'      => (!empty($kormocari_data_get)? json_encode($kormocari_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $kormocari_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_kormocari')->with('message', 'Successfully Save');   
            }



        }else{

            $kormocari_data_get[] = $upazila_kormocari_info;

            $upazila_basic_info_data = [
                'kormocari'      => (!empty($kormocari_data_get)? json_encode($kormocari_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            if($data_save){
                
                  return redirect()->route('pourosova_related.pourosova_kormocari')->with('message', 'Successfully Save');  

            }
        }

    }

    
    public function pourosova_kormocari_edit($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormocari', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->kormocari);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $kormocari_data = array_values($info);

        return view('pourosova_related.pourosova_kormocari_edit', compact('kormocari_data'));
    }

    public function pourosova_kormocari_update(Request $request, $id)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormocari', '!=', NULL)->first();

        $kormocari_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $kormocari_data_get = json_decode($if_exist_check_info->kormocari);

        $key = array_search($id, array_column($kormocari_data_get, 'id'));


        $upazila_kormocari_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'view_order'     => $request->view_order,
            'designation'    => $request->designation,
            'responsibilities'=> $request->responsibilities,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($kormocari_data_get)){

            $kormocari_data_get[$key] = $upazila_kormocari_info;

            $upazila_basic_info_data = [
                'kormocari'      => (!empty($kormocari_data_get)? json_encode($kormocari_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $kormocari_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_kormocari')->with('message', 'Successfully Updated');   
            }
        }

        }

        public function pourosova_kormocari_delete($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormocari', '!=', NULL)->first();

        $kormocari_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $kormocari_data_get = json_decode($if_exist_check_info->kormocari);

        $key = array_search($id, array_column($kormocari_data_get, 'id'));

        $info = array_filter($kormocari_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $kormocari_data = array_values($info);


        $upazila_kormocari_info = [
            'id'             => $id,
            'name'           => $kormocari_data[0]->name,
            'mobile'         => $kormocari_data[0]->mobile,
            'email'          => $kormocari_data[0]->email,
            'view_order'     => $kormocari_data[0]->view_order,
            'designation'    => $kormocari_data[0]->designation,
            'responsibilities'=> $kormocari_data[0]->responsibilities,
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($kormocari_data_get)){

            $kormocari_data_get[$key] = $upazila_kormocari_info;

            $upazila_basic_info_data = [
                'kormocari'      => (!empty($kormocari_data_get)? json_encode($kormocari_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $kormocari_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_kormocari')->with('message', 'Successfully Deleted');   
            }
        }

        }


      // kormokorta
    public function pourosova_kormokorta(Request $request)
    {
         $if_exist_check_info = Upazila_basic_info::where('kormokorta', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->kormokorta) ? json_decode($if_exist_check_info->kormokorta) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('pourosova_related.pourosova_kormokorta', compact('data'));
    }

    public function pourosova_kormokorta_create()
    {
        return view('pourosova_related.pourosova_kormokorta_create');
    }

    public function pourosova_kormokorta_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormokorta', '!=', NULL)->first();

        $kormokorta_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($kormokorta_id > 0){

            $kormokorta_data_get = json_decode($if_exist_check_info->kormokorta);


            $id = count((array)$kormokorta_data_get)+1;

        }else{

            $id = 1;
        }


        $upazila_kormokorta_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'view_order'     => $request->view_order,
            'designation'    => $request->designation,
            'responsibilities'=> $request->responsibilities,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($kormokorta_data_get)){

            $kormokorta_data_get[] = $upazila_kormokorta_info;

            $upazila_basic_info_data = [
                'kormokorta'      => (!empty($kormokorta_data_get)? json_encode($kormokorta_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $kormokorta_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('pourosova_related.pourosova_kormokorta')->with('message', 'Successfully Save');   
            }



        }else{

            $kormokorta_data_get[] = $upazila_kormokorta_info;

            $upazila_basic_info_data = [
                'kormokorta'      => (!empty($kormokorta_data_get)? json_encode($kormokorta_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            if($data_save){
                
                  return redirect()->route('pourosova_related.pourosova_kormokorta')->with('message', 'Successfully Save');  

            }
        }

    }

    
    public function pourosova_kormokorta_edit($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormokorta', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->kormokorta);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $kormokorta_data = array_values($info);

        return view('pourosova_related.pourosova_kormokorta_edit', compact('kormokorta_data'));
    }

    public function pourosova_kormokorta_update(Request $request, $id)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormokorta', '!=', NULL)->first();

        $kormokorta_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $kormokorta_data_get = json_decode($if_exist_check_info->kormokorta);

        $key = array_search($id, array_column($kormokorta_data_get, 'id'));


        $upazila_kormokorta_info = [
            'id'             => $id,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'view_order'     => $request->view_order,
            'designation'    => $request->designation,
            'responsibilities'=> $request->responsibilities,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($kormokorta_data_get)){

            $kormokorta_data_get[$key] = $upazila_kormokorta_info;

            $upazila_basic_info_data = [
                'kormokorta'      => (!empty($kormokorta_data_get)? json_encode($kormokorta_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $kormokorta_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_kormokorta')->with('message', 'Successfully Updated');   
            }
        }

        }

        public function pourosova_kormokorta_delete($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('kormokorta', '!=', NULL)->first();

        $kormokorta_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $kormokorta_data_get = json_decode($if_exist_check_info->kormokorta);

        $key = array_search($id, array_column($kormokorta_data_get, 'id'));

        $info = array_filter($kormokorta_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $kormokorta_data = array_values($info);


        $upazila_kormokorta_info = [
            'id'             => $id,
            'name'           => $kormokorta_data[0]->name,
            'mobile'         => $kormokorta_data[0]->mobile,
            'email'          => $kormokorta_data[0]->email,
            'view_order'     => $kormokorta_data[0]->view_order,
            'designation'    => $kormokorta_data[0]->designation,
            'responsibilities'=> $kormokorta_data[0]->responsibilities,
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($kormokorta_data_get)){

            $kormokorta_data_get[$key] = $upazila_kormokorta_info;

            $upazila_basic_info_data = [
                'kormokorta'      => (!empty($kormokorta_data_get)? json_encode($kormokorta_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $kormokorta_id)->update($upazila_basic_info_data);

            if($data_save){

                return redirect()->route('pourosova_related.pourosova_kormokorta')->with('message', 'Successfully Deleted');   
            }
        }

        }


   // Pourosova ward

    public function pourosova_ward(Request $request)
    {
         $if_exist_check_info = Upazila_basic_info::where('pourosova_ward', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->pourosova_ward) ? json_decode($if_exist_check_info->pourosova_ward) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   


        return view('pourosova_related.pourosova_ward', compact('data'));
    }

    public function pourosova_ward_create()
    {
        return view('pourosova_related.pourosova_ward_create');
    }

    public function pourosova_ward_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('pourosova_ward', '!=', NULL)->first();

        $ward_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($ward_id > 0){

            $ward_data_get = json_decode($if_exist_check_info->pourosova_ward);

            $id = count((array)$ward_data_get)+1;

        }else{

            $id = 1;
        }


        $upazila_ward_info = [
            'id'             => $id,
            'ward_no'        => $request->ward_no,
            'village'        => $request->village,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($ward_data_get)){

            $ward_data_get[] = $upazila_ward_info;

            $upazila_basic_info_data = [
                'pourosova_ward'  => (!empty($ward_data_get)? json_encode($ward_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $ward_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('pourosova_related.pourosova_ward')->with('message', 'Successfully Save');   
            }

        }else{

            $ward_data_get[] = $upazila_ward_info;

            $upazila_basic_info_data = [
                'pourosova_ward'  => (!empty($ward_data_get)? json_encode($ward_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            if($data_save){
                
                  return redirect()->route('pourosova_related.pourosova_ward')->with('message', 'Successfully Save');  

            }
        }

    }

    public function pourosova_ward_edit($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('pourosova_ward', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->pourosova_ward);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $ward_data = array_values($info);

        return view('pourosova_related.pourosova_ward_edit', compact('ward_data'));
    }

    public function pourosova_ward_update(Request $request, $id)
    {

        $if_exist_check_info = Upazila_basic_info::where('pourosova_ward', '!=', NULL)->first();

        $ward_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $ward_data_get = json_decode($if_exist_check_info->pourosova_ward);

        $key = array_search($id, array_column($ward_data_get, 'id'));


        $upazila_ward_info = [
            'id'             => $id,
            'ward_no'        => $request->ward_no,
            'village'        => $request->village,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($ward_data_get)){

            $ward_data_get[$key] = $upazila_ward_info;

            $upazila_basic_info_data = [
                'pourosova_ward'  => (!empty($ward_data_get)? json_encode($ward_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $ward_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('pourosova_related.pourosova_ward')->with('message', 'Successfully Updated');   
            }

        }
    }

    public function pourosova_ward_delete($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('pourosova_ward', '!=', NULL)->first();

        $ward_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $ward_data_get = json_decode($if_exist_check_info->pourosova_ward);

        $key = array_search($id, array_column($ward_data_get, 'id'));

    
        $info = array_filter($ward_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $ward_data = array_values($info);


        $upazila_ward_info = [
            'id'             => $id,
            'ward_no'        => $ward_data[0]->ward_no,
            'village'        => $ward_data[0]->village,
            'view_order'     => $ward_data[0]->view_order,
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($ward_data_get)){

            $ward_data_get[$key] = $upazila_ward_info;

            $upazila_basic_info_data = [
                'pourosova_ward'  => (!empty($ward_data_get)? json_encode($ward_data_get):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $ward_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('pourosova_related.pourosova_ward')->with('message', 'Successfully Deleted');   
            }

        }
    }

    public function citizen_charter(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('citizen_charter', '!=', NULL)->first();

        if($request->ajax()){
            $informations = !empty($if_exist_check_info->citizen_charter) ? json_decode($if_exist_check_info->citizen_charter) : [];

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
                     
                        $html.='<button class="btn btn-primary btn-xs citizenCharterEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs citizenCharterDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>'; 

                    return $html;
                })
                ->rawColumns(['is_active','action'])
                ->make(true);
        }
            $all_type_info = AllTypeTitle::where('is_active','!=',0)
                                    ->where('type','=',3)
                                    ->get();

            return view('pourosova_related.citizen_charter', compact('all_type_info'));
        
    }

    public function citizen_charter_store(Request $request)
    {
        

        $if_exist_check_info = Upazila_basic_info::where('citizen_charter', '!=', NULL)->first();


        $citizen_charter_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($citizen_charter_id > 0){

            $citizen_charter_data_get = json_decode($if_exist_check_info->citizen_charter);


            $id = count((array)$citizen_charter_data_get)+1;

        }else{

            $id = 1;
        }

        $citizen_charter_info = [
            'id'               => $id,
            'services'         => $request->services,
            'services_process' => $request->services_process,
            'services_price'    => $request->services_price,
            'services_time'     => $request->services_time,
            'type'             => $request->type,
            'is_active'        => $request->is_active,
            'created_by'       => Auth::user()->id,
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];

      

        if (!empty($citizen_charter_data_get)){
            $citizen_charter_data_get[] =$citizen_charter_info;

            $upazila_basic_info_data = [
                'citizen_charter'=> (!empty($citizen_charter_data_get)? json_encode($citizen_charter_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
           
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $citizen_charter_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);


        }else{
            $citizen_charter_data_get[] =$citizen_charter_info;

            $upazila_basic_info_data = [
                'citizen_charter'=> (!empty($citizen_charter_data_get)? json_encode($citizen_charter_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
           
            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);
            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }

    }

    public function citizen_charter_edit(Request $request)
    {
        $if_exist_check_info = Upazila_basic_info::where('citizen_charter', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->citizen_charter);

        $info = array_filter($informations, function($info) use($request){
            return $info->id == $request->id;
        });


        return response()->json([
            'status' => !empty($info) ? 'success' : 'error',
            'msg'    => !empty($info) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($info) ? array_values($info) : []
        ]);
    }

    public function citizen_charter_update(Request $request)
    {
        $id = $request->citizen_charter_id;

        $if_exist_check_info = Upazila_basic_info::where('citizen_charter', '!=', NULL)->first();

        $citizen_charter_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $citizen_charter_data_get = json_decode($if_exist_check_info->citizen_charter);

        $key = array_search($request->citizen_charter_id, array_column($citizen_charter_data_get, 'id'));
    
        $citizen_charter_info = [
            'id'               => $id,
            'services'         => $request->services,
            'services_process' => $request->services_process,
            'services_price'    => $request->services_price,
            'services_time'     => $request->services_time,
            'type'             => $request->type,
            'is_active'        => $request->is_active,
            'created_by'       => Auth::user()->id,
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];



        if (!empty($citizen_charter_data_get)){
            $citizen_charter_data_get[$key] = $citizen_charter_info;

            $upazila_basic_info_data = [
                'citizen_charter'=> (!empty($citizen_charter_data_get)? json_encode($citizen_charter_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
            
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $citizen_charter_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }
    }

    public function citizen_charter_destroy(Request $request){

        $id = $request->id;

        $if_exist_check_info = Upazila_basic_info::where('citizen_charter', '!=', NULL)->first();

       
        $citizen_charter_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $citizen_charter_data_get = json_decode($if_exist_check_info->citizen_charter);

        $key = array_search($request->id, array_column($citizen_charter_data_get, 'id'));

        $info = array_filter($citizen_charter_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $citizen_charter = array_values($info);

    
        $citizen_charter_info = [
            'id'               => $id,
            'services'         => $citizen_charter[0]->services,
            'services_process' => $citizen_charter[0]->services_process,
            'services_price'    => $citizen_charter[0]->services_price,
            'services_time'     => $citizen_charter[0]->services_time,
            'type'             => $citizen_charter[0]->type,
            'is_active'        => 0,
            'created_by'       => Auth::user()->id,
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];


        if (!empty($citizen_charter_data_get)){
            $citizen_charter_data_get[$key] = $citizen_charter_info;

            $upazila_basic_info_data = [
                'citizen_charter'=> (!empty($citizen_charter_data_get)? json_encode($citizen_charter_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
            
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $citizen_charter_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Delated' : 'Someting went wrong',
            ]);
        }
        
    }

}

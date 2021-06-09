<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class PourosovaRelatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pourosova_mayor(Request $request)
    {
         $if_exist_check_info = DB::table('upazila_basic_info')->where('mayor', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('mayor', '!=', NULL)->first();

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
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get):NULL),
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
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get):NULL),
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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('mayor', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->mayor);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $mayor_data = array_values($info);

        return view('pourosova_related.pourosova_mayor_edit', compact('mayor_data'));
    }

    public function pourosova_mayor_update(Request $request, $id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('mayor', '!=', NULL)->first();

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
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get):NULL),
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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('mayor', '!=', NULL)->first();

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
                'mayor'           => (!empty($mayor_data_get)? json_encode($mayor_data_get):NULL),
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
         $if_exist_check_info = DB::table('upazila_basic_info')->where('councilor', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('councilor', '!=', NULL)->first();

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
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('councilor', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->councilor);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $councilor_data = array_values($info);

        return view('pourosova_related.pourosova_councilor_edit', compact('councilor_data'));
    }

    public function pourosova_councilor_update(Request $request, $id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('councilor', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('councilor', '!=', NULL)->first();

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

    public function pourosova_kormokorta(Request $request)
    {
         $if_exist_check_info = DB::table('upazila_basic_info')->where('kormokorta', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('kormokorta', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('kormokorta', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->kormokorta);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $kormokorta_data = array_values($info);

        return view('pourosova_related.pourosova_kormokorta_edit', compact('kormokorta_data'));
    }

    public function pourosova_kormokorta_update(Request $request, $id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('kormokorta', '!=', NULL)->first();

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

                return redirect()->route('pourosova_related.pourosova_kormokorta')->with('message', 'Successfully Save');   
            }
        }

        }

        public function pourosova_kormokorta_delete($id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('kormokorta', '!=', NULL)->first();

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

        // Pourosova waed

    public function pourosova_ward(Request $request)
    {
         $if_exist_check_info = DB::table('upazila_basic_info')->where('pourosova_ward', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('pourosova_ward', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('pourosova_ward', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->pourosova_ward);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $ward_data = array_values($info);

        return view('pourosova_related.pourosova_ward_edit', compact('ward_data'));
    }

    public function pourosova_ward_update(Request $request, $id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('pourosova_ward', '!=', NULL)->first();

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
                return redirect()->route('pourosova_related.pourosova_ward')->with('message', 'Successfully Save');   
            }

        }
    }

    public function pourosova_ward_delete($id)
    {

        $if_exist_check_info = DB::table('upazila_basic_info')->where('pourosova_ward', '!=', NULL)->first();

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

}

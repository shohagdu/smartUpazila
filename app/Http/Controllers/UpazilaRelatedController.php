<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AllTypeTitle;
use App\Models\Upazila_basic_info;
use DataTables;
use Session;
use DB;

class UpazilaRelatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       
        $if_exist_check_info = Upazila_basic_info::where('introduction', '!=', NULL)->first();


        if($request->ajax()){
           $informations = !empty($if_exist_check_info->introduction) ? json_decode($if_exist_check_info->introduction) : [];

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

               $all_type_info = AllTypeTitle::where('is_active','!=','0')
                                    ->where('type','=','1')
                                    ->get();

        return view('upazila_related.upazilaIntroduction', compact('all_type_info'));
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


        $if_exist_check_info = Upazila_basic_info::where('introduction', '!=', NULL)->first();

        $introduction_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($introduction_id > 0){

            $introduction_data_get = json_decode($if_exist_check_info->introduction);


            $id = count((array)$introduction_data_get)+1;

        }else{

            $id = 1;
        }

        $introduction_info = [
            'id'               => $id,
            'title'            => $request->title,
            'description'      => $request->description,
            'display_position' => $request->display_position,
            'is_active'        => $request->is_active,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];


        if (!empty($introduction_data_get)){
            $introduction_data_get[] = $introduction_info;

            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'created_ip'  => request()->ip(),
                'created_at'   => date('Y-m-d H:i:s'),
            ];
           
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $introduction_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);


        }else{
            $introduction_data_get[] =$introduction_info;

            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
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
        $if_exist_check_info = Upazila_basic_info::where('introduction', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->introduction);

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
        $id = $request->introduction_id;

        $if_exist_check_info = Upazila_basic_info::where('introduction', '!=', NULL)->first();

        $introduction_data_get= !empty($if_exist_check_info->introduction)?json_decode($if_exist_check_info->introduction,true):NULl;

         $key = array_search($request->introduction_id, array_column($introduction_data_get, 'id'));


         $introduction_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

         $introduction_info = [
            'id'               => $id,
            'title'            => $request->title,
            'description'      => $request->description,
            'display_position' => $request->display_position,
            'is_active'        => $request->is_active,
            'updated_by'       => Auth::user()->id,
            'updated_ip'       => request()->ip(),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if (!empty($introduction_data_get)){
            $introduction_data_get[$key] = $introduction_info;

            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
                'is_active'   => $request->is_active,
                'updated_by'  => Auth::user()->id,
                'updated_ip'  => request()->ip(),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];
          
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $introduction_id)->update($upazila_basic_info_data);

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

        $if_exist_check_info = Upazila_basic_info::where('introduction', '!=', NULL)->first();

        $introduction_data_get= json_decode($if_exist_check_info->introduction);


         $id = $request->id;

        $info = array_filter($introduction_data_get, function($info) use($id){
            return $info->id == $id;
        });


         $introduction_data_info = array_values($info);

         $key = array_search($request->id, array_column($introduction_data_get, 'id'));

         $introduction_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


         $introduction_info = [
            'id'               => $id,
            'title'            => $introduction_data_info[0]->title,
            'description'      => $introduction_data_info[0]->description,
            'display_position' => $introduction_data_info[0]->display_position,
            'is_active'        => 0,
            'updated_by'       => Auth::user()->id,
            'updated_ip'       => request()->ip(),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];



        if (!empty($introduction_data_get)){


            unset($introduction_data_get[$key]);


            $introduction_data_get[$key] = $introduction_info;


            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
                'is_active'   => $request->is_active,
                'updated_by'  => Auth::user()->id,
                'updated_ip'  => request()->ip(),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];


            $data_delete = DB::table('upazila_basic_info')->where('id', '=', $introduction_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_delete ? 'success' : 'error',
                'msg'    => $data_delete ? 'Successfully Delete' : 'Someting went wrong',
            ]);


        }
    }


    //up_history
    public function up_history(){

        $if_exist_check_info = Upazila_basic_info::where('history', '!=', NULL)->first();
        $data = !empty($if_exist_check_info->history) ? json_decode($if_exist_check_info->history) : NULL;

        $history =  !empty($data) ?  $data->history : NULL;


        return view('upazila_related.up_history', compact('history'));
    }

    public function up_history_store(Request $request){

        $history = $request->history;

        $if_exist_check_info = Upazila_basic_info::where('history', '!=', NULL)->first();

        $history_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;



        $history_info = [
            'history'           => $history,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];


            if(!empty($if_exist_check_info)){


                $upazila_basic_info_data = [
                    'history'=> (!empty($history_info)? json_encode($history_info, JSON_UNESCAPED_UNICODE ):NULL),
                    'is_active'   =>1,
                    'updated_by'  => Auth::user()->id,
                    'updated_ip'  => request()->ip(),
                    'updated_at'   => date('Y-m-d H:i:s'),
                ];


                $data_save = DB::table('upazila_basic_info')->where('id', '=', $history_id)->update($upazila_basic_info_data);

                return redirect()->route('upazila_related.up_history')->with('message', 'Successfully Saved');

            }else{

                $upazila_basic_info_data = [
                    'history'=> (!empty($history_info)? json_encode($history_info, JSON_UNESCAPED_UNICODE):NULL),
                    'is_active'   => 1,
                    'created_by'  => Auth::user()->id,
                    'created_ip'  => request()->ip(),
                    'created_at'   => date('Y-m-d H:i:s'),
                ];

                $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

                return redirect()->route('upazila_related.up_history')->with('message', 'Successfully Save');

            }

    }

    // upazila_geographical
    public function upazila_geographical(){

        $if_exist_check_info = Upazila_basic_info::where('geographical_view', '!=', NULL)->first();

        $data = !empty($if_exist_check_info->geographical_view) ? json_decode($if_exist_check_info->geographical_view) : NULL;

        $geographical_view =  !empty($data) ?  $data->geographical_view : NULL;



        return view('upazila_related.upazila_geographical', compact('geographical_view'));
    }

    public function upazila_geographical_store(Request $request){

        $geographical_view = $request->geographical_view;

        $if_exist_check_info = Upazila_basic_info::where('geographical_view', '!=', NULL)->first();

        $geographical_view_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;



        $geographical_info = [
            'geographical_view'=> $geographical_view,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];


        if(!empty($if_exist_check_info)){


                $upazila_basic_info_data = [
                    'geographical_view'=> (!empty($geographical_info)? json_encode($geographical_info, JSON_UNESCAPED_UNICODE):NULL),
                    'is_active'        =>1,
                    'updated_by'       => Auth::user()->id,
                    'updated_ip'       => request()->ip(),
                    'updated_at'       => date('Y-m-d H:i:s'),
                ];


                $data_save = DB::table('upazila_basic_info')->where('id', '=', $geographical_view_id)->update($upazila_basic_info_data);

                return redirect()->route('upazila_related.upazila_geographical')->with('message', 'Successfully Saved');

            }else{

                $upazila_basic_info_data = [
                    'geographical_view'=> (!empty($geographical_info)? json_encode($geographical_info, JSON_UNESCAPED_UNICODE):NULL),
                    'is_active'   => 1,
                    'created_by'  => Auth::user()->id,
                    'created_ip'  => request()->ip(),
                    'created_at'   => date('Y-m-d H:i:s'),
                ];


                $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

                return redirect()->route('upazila_related.upazila_geographical')->with('message', 'Successfully Save');

            }

    }
  //  upPublicPeprestative
    public function upPublicPeprestative(Request $request){


        $if_exist_check_info = DB::table('upazila_basic_info')->where('representative_upazila_organogram', '!=', NULL)->first();


        $if_exist_check_info = Upazila_basic_info::where('representative_upazila_organogram', '!=', NULL)->first();


        if($request->ajax()){
           $informations = !empty($if_exist_check_info->representative_upazila_organogram) ? json_decode($if_exist_check_info->representative_upazila_organogram) : [];

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

                        $html.='<button class="btn btn-primary btn-xs upPeprestativeEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs upPeprestativeDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>';

                    return $html;
                })
                ->rawColumns(['title','is_active','action'])
                ->make(true);
        }else{

        return view('upazila_related.up_public_peprestative');
        }

    }

    public function up_public_peprestative_store(Request $request){

        $if_exist_check_info = Upazila_basic_info::where('representative_upazila_organogram', '!=', NULL)->first();


        $representative_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($representative_id > 0){
            $representative_data_get = json_decode($if_exist_check_info->representative_upazila_organogram);
            $id = count((array)$representative_data_get)+1;

        }else{

            $id = 1;
        }

        $representative_info = [
            'id'          => $id,
            'name'        => $request->name,
            'mobile'      => $request->mobile,
            'email'       => $request->email,
            'designation' => $request->designation,
            'address'     => $request->address,
            'is_active'   => $request->is_active,
            'created_by'  => Auth::user()->id,
            'created_ip'  => request()->ip(),
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        // dd($representative_info);

        if (!empty($representative_data_get)){
            $representative_data_get[] = $representative_info;

            $upazila_basic_info_data = [
                'representative_upazila_organogram' => (!empty($representative_data_get)? json_encode($representative_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'                         => $request->is_active,
                'created_by'                        => Auth::user()->id,
                'created_ip'                        => request()->ip(),
                'created_at'                        => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $representative_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);


        }else{
            $representative_data_get[] = $representative_info;

            $upazila_basic_info_data = [
                'representative_upazila_organogram' => (!empty($representative_data_get)? json_encode($representative_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'                         => $request->is_active,
                'created_by'                        => Auth::user()->id,
                'created_ip'                        => request()->ip(),
                'created_at'                        => date('Y-m-d H:i:s'),
            ];
           
            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);
            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }
    }

    public function up_public_peprestative_edit(Request $request)
    {
        $if_exist_check_info = Upazila_basic_info::where('representative_upazila_organogram', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->representative_upazila_organogram);

        $info = array_filter($informations, function($info) use($request){
            return $info->id == $request->id;
        });


        return response()->json([
            'status' => !empty($info) ? 'success' : 'error',
            'msg'    => !empty($info) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($info) ? array_values($info) : []
        ]);
    }

    public function up_public_peprestative_update(Request $request){

        $id = $request->peprestative_id;

        $if_exist_check_info = Upazila_basic_info::where('representative_upazila_organogram', '!=', NULL)->first();

        $representative_data_get = json_decode($if_exist_check_info->representative_upazila_organogram);

        $key = array_search($request->peprestative_id, array_column($representative_data_get, 'id'));


        $representative_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        $representative_info = [
            'id'          => $id,
            'name'        => $request->name,
            'mobile'      => $request->mobile,
            'email'       => $request->email,
            'designation' => $request->designation,
            'address'     => $request->address,
            'is_active'   => $request->is_active,
            'updated_by'  => Auth::user()->id,
            'updated_ip'  => request()->ip(),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        ///dd($representative_info);

        if (!empty($representative_data_get)){
            $representative_data_get[$key] = $representative_info;

            $upazila_basic_info_data = [
                'representative_upazila_organogram' => (!empty($representative_data_get)? json_encode($representative_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'                         => $request->is_active,
                'updated_by'                        => Auth::user()->id,
                'updated_ip'                        => request()->ip(),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $representative_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Updated' : 'Someting went wrong',
            ]);

        }
    }

    public function up_public_peprestative_delete(Request $request){

        $if_exist_check_info = Upazila_basic_info::where('representative_upazila_organogram', '!=', NULL)->first();

        $representative_data_get = json_decode($if_exist_check_info->representative_upazila_organogram);

        $id = $request->id;

        $info = array_filter($representative_data_get, function($info) use($id){
            return $info->id == $id;
        });

        $representative_data_info = array_values($info);

        $key = array_search($request->id, array_column($representative_data_get, 'id'));


        $representative_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        $representative_info = [
            'id'          => $request->id,
            'name'        => $representative_data_info[0]->name,
            'mobile'      => $representative_data_info[0]->mobile,
            'email'       => $representative_data_info[0]->email,
            'designation' => $representative_data_info[0]->designation,
            'address'     => $representative_data_info[0]->address,
            'is_active'   => 0,
            'updated_by'  => Auth::user()->id,
            'updated_ip'  => request()->ip(),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];


        if (!empty($representative_data_get)){

            $representative_data_get[$key] = $representative_info;

            $upazila_basic_info_data = [
                'representative_upazila_organogram' => (!empty($representative_data_get)? json_encode($representative_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'                         => $request->is_active,
                'updated_by'                        => Auth::user()->id,
                'updated_ip'                        => request()->ip(),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $representative_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Deleted' : 'Someting went wrong',
            ]);

        }
    }

    public function freedom_fighter(Request $request){


        $if_exist_check_info = DB::table('upazila_basic_info')->where('freedom_fighter', '!=', NULL)->first();

        $if_exist_check_info = Upazila_basic_info::where('freedom_fighter', '!=', NULL)->first();



        if($request->ajax()){
           $informations = !empty($if_exist_check_info->freedom_fighter) ? json_decode($if_exist_check_info->freedom_fighter) : [];

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

                        $html.='<button class="btn btn-primary btn-xs upFreedomFighterEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs upFreedomFighterDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>';

                    return $html;
                })
                ->rawColumns(['title','is_active','action'])
                ->make(true);
        }else{

        return view('upazila_related.freedom_fighter');
        }
    }

    public function freedom_fighter_store(Request $request){

        $if_exist_check_info = Upazila_basic_info::where('freedom_fighter', '!=', NULL)->first();


        $freedom_fighter_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($freedom_fighter_id > 0){

            $freedom_fighter_data_get = json_decode($if_exist_check_info->freedom_fighter);


            $id = count((array)$freedom_fighter_data_get)+1;

        }else{

            $id = 1;
        }

        $freedom_fighter_info = [
            'id'          => $id,
            'name'        => $request->name,
            'father_name' => $request->father_name,
            'village'     => $request->village,
            'is_active'   => $request->is_active,
            'created_by'  => Auth::user()->id,
            'created_ip'  => request()->ip(),
            'created_at'  => date('Y-m-d H:i:s'),
        ];



        if (!empty($freedom_fighter_data_get)){
            $freedom_fighter_data_get[] = $freedom_fighter_info;

            $upazila_basic_info_data = [
                'freedom_fighter' => (!empty($freedom_fighter_data_get)? json_encode($freedom_fighter_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];
       // dd($upazila_basic_info_data);
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $freedom_fighter_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);


        }else{
            $freedom_fighter_data_get[] = $freedom_fighter_info;

            $upazila_basic_info_data = [
                'freedom_fighter' => (!empty($freedom_fighter_data_get)? json_encode($freedom_fighter_data_get):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];
           //dd($upazila_basic_info_data);
            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);
            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }

    }


    public function freedom_fighter_edit(Request $request)
    {
        $if_exist_check_info = Upazila_basic_info::where('freedom_fighter', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->freedom_fighter);

        $info = array_filter($informations, function($info) use($request){
            return $info->id == $request->id;
        });


        return response()->json([
            'status' => !empty($info) ? 'success' : 'error',
            'msg'    => !empty($info) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($info) ? array_values($info) : []
        ]);
    }

    public function freedom_fighter_update(Request $request){

        $id = $request->freedom_fighter_id;

        $if_exist_check_info = Upazila_basic_info::where('freedom_fighter', '!=', NULL)->first();

        $freedom_fighter_data_get = json_decode($if_exist_check_info->freedom_fighter);

        $freedom_fighter_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $key = array_search($request->freedom_fighter_id, array_column($freedom_fighter_data_get, 'id'));


        $freedom_fighter_info = [
            'id'          => $id,
            'name'        => $request->name,
            'father_name' => $request->father_name,
            'village'     => $request->village,
            'is_active'   => $request->is_active,
            'updated_by'  => Auth::user()->id,
            'updated_ip'  => request()->ip(),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if (!empty($freedom_fighter_data_get)){
            $freedom_fighter_data_get[$key] = $freedom_fighter_info;

            $upazila_basic_info_data = [
                'freedom_fighter' => (!empty($freedom_fighter_data_get)? json_encode($freedom_fighter_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $freedom_fighter_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Updated' : 'Someting went wrong',
            ]);

        }

    }

    public function freedom_fighter_delete(Request $request){

        $if_exist_check_info = Upazila_basic_info::where('freedom_fighter', '!=', NULL)->first();

        $freedom_fighter_data_get = json_decode($if_exist_check_info->freedom_fighter);


        $id = $request->id;

        $info = array_filter($freedom_fighter_data_get, function($info) use($id){
            return $info->id == $id;
        });

        $freedom_fighter_data_info = array_values($info);


        $freedom_fighter_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $key = array_search($request->id, array_column($freedom_fighter_data_get, 'id'));

        $freedom_fighter_info = [
            'id'          => $request->id,
            'name'        => $freedom_fighter_data_info[0]->name,
            'father_name' => $freedom_fighter_data_info[0]->father_name,
            'village'     => $freedom_fighter_data_info[0]->village,
            'is_active'   => 0,
            'updated_by'  => Auth::user()->id,
            'updated_ip'  => request()->ip(),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];


        if (!empty($freedom_fighter_data_get)){
            $freedom_fighter_data_get[$key] = $freedom_fighter_info;

            $upazila_basic_info_data = [
                'freedom_fighter' => (!empty($freedom_fighter_data_get)? json_encode($freedom_fighter_data_get):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $freedom_fighter_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_save ? 'success' : 'error',
                'msg'    => $data_save ? 'Successfully Deleted' : 'Someting went wrong',
            ]);

        }
    }

    // slider 

    public function slider(Request $request)
    {
         $if_exist_check_info = Upazila_basic_info::where('slider', '!=', NULL)->first();

         $informations = !empty($if_exist_check_info->slider) ? json_decode($if_exist_check_info->slider) : [];

         $data = array_filter($informations, function($data){
            return $data->is_active != 0;
        });   

        return view('upazila_related.slider', compact('data'));
    }

    public function slider_create()
    {
        return view('upazila_related.slider_create');
    }

    public function slider_store(Request $request)
    {

        $if_exist_check_info = Upazila_basic_info::where('slider', '!=', NULL)->first();

        $slider_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if ($slider_id > 0){

            $slider_data_get = json_decode($if_exist_check_info->slider);


            $id = count((array)$slider_data_get)+1;

        }else{

            $id = 1;
        }


        if(isset($request->image)){

            $imageName = 'slider_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/slider', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $upazila_slider_info = [
            'id'             => $id,
            'title'          => $request->title,
            'description'    => $request->description,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($slider_data_get)){

            $slider_data_get[] = $upazila_slider_info;

            $upazila_basic_info_data = [
                'slider'       => (!empty($slider_data_get)? json_encode($slider_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];
        
            $data_save = DB::table('upazila_basic_info')->where('id', '=', $slider_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('upazila_related.slider')->with('message', 'Successfully Save');   
            }



        }else{

            $slider_data_get[] = $upazila_slider_info;

            $upazila_basic_info_data = [
                'slider'       => (!empty($slider_data_get)? json_encode($slider_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'created_by'      => Auth::user()->id,
                'created_ip'      => request()->ip(),
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

            if($data_save){
                
                  return redirect()->route('upazila_related.slider')->with('message', 'Successfully Save');  

            }
        }
    }

    public function slider_edit($id)
    {

        $if_exist_check_info = Upazila_basic_info::where('slider', '!=', NULL)->first();

        $informations  = json_decode($if_exist_check_info->slider);

        $info = array_filter($informations, function($info) use($id){
            return $info->id == $id;
        });   
         $slider_data = array_values($info);

        return view('upazila_related.slider_edit', compact('slider_data'));
    }

    public function slider_update(Request $request, $id){

        $if_exist_check_info = Upazila_basic_info::where('slider', '!=', NULL)->first();

        $slider_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $slider_data_get = json_decode($if_exist_check_info->slider);

        $key = array_search($id, array_column($slider_data_get, 'id'));


        if(isset($request->image)){

            $imageName = 'slider_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/slider', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_image;
  
          }

        $upazila_slider_info = [
            'id'             => $id,
            'title'          => $request->title,
            'description'    => $request->description,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($slider_data_get)){

            $slider_data_get[$key] = $upazila_slider_info;

            $upazila_basic_info_data = [
                'slider'       => (!empty($slider_data_get)? json_encode($slider_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => $request->is_active,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
    

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $slider_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('upazila_related.slider')->with('message', 'Successfully Updated');   
            }
        }
    }

    public function slider_delete(Request $request, $id){

        $if_exist_check_info = Upazila_basic_info::where('slider', '!=', NULL)->first();

        $slider_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $slider_data_get = json_decode($if_exist_check_info->slider);

        $info = array_filter($slider_data_get, function($info) use($id){
            return $info->id == $id;
        }); 

         $slider_data = array_values($info);

        $key = array_search($id, array_column($slider_data_get, 'id'));



        $upazila_slider_info = [
            'id'             => $id,
            'title'          => $slider_data[0]->title,
            'description'    => $slider_data[0]->description,
            'image'          => $slider_data[0]->image,
            'view_order'     => $slider_data[0]->view_order,
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];


        if (!empty($slider_data_get)){

            $slider_data_get[$key] = $upazila_slider_info;

            $upazila_basic_info_data = [
                'slider'       => (!empty($slider_data_get)? json_encode($slider_data_get, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'       => 1,
                'updated_by'      => Auth::user()->id,
                'updated_ip'      => request()->ip(),
                'updated_at'      => date('Y-m-d H:i:s'),
            ];
    

            $data_save = DB::table('upazila_basic_info')->where('id', '=', $slider_id)->update($upazila_basic_info_data);

            if($data_save){
                return redirect()->route('upazila_related.slider')->with('message', 'Successfully Delete');   
            }
        }
    }

     //social_media
     public function social_media(){

        $if_exist_check_info = Upazila_basic_info::where('social_media', '!=', NULL)->first();
        $data = !empty($if_exist_check_info->social_media) ? json_decode($if_exist_check_info->social_media) : NULL;

        $social_media =  !empty($data) ?  $data : NULL;


        
        return view('upazila_related.social_media', compact('social_media'));
    }

    public function social_media_store(Request $request){


        $if_exist_check_info = Upazila_basic_info::where('social_media', '!=', NULL)->first();

        $social_media_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

       

        $social_media_info = [
            'facebook_link'    => $request->facebook_link,
            'youtube_link'     => $request->youtube_link,
            'twitter_link'     => $request->twitter_link,
            'instagram_link'   => $request->instagram_link,
            'created_by'       => Auth::user()->id,
            'created_ip'       => request()->ip(),
            'created_at'       => date('Y-m-d H:i:s'),
        ];
        

            if(!empty($if_exist_check_info)){

                $upazila_basic_info_data = [
                    'social_media'=> (!empty($social_media_info)? json_encode($social_media_info, JSON_UNESCAPED_UNICODE ):NULL),
                    'is_active'   =>1,
                    'updated_by'  => Auth::user()->id,
                    'updated_ip'  => request()->ip(),
                    'updated_at'   => date('Y-m-d H:i:s'),
                ];

                
                $data_save = DB::table('upazila_basic_info')->where('id', '=', $social_media_id)->update($upazila_basic_info_data);

                return redirect()->route('upazila_related.social_media')->with('message', 'Successfully Saved');   

            }else{

                $upazila_basic_info_data = [
                    'social_media'=> (!empty($social_media_info)? json_encode($social_media_info, JSON_UNESCAPED_UNICODE):NULL),
                    'is_active'   => 1,
                    'created_by'  => Auth::user()->id,
                    'created_ip'  => request()->ip(),
                    'created_at'   => date('Y-m-d H:i:s'),
                ];
         
                $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

                return redirect()->route('upazila_related.social_media')->with('message', 'Successfully Save');   

            }

    }

}

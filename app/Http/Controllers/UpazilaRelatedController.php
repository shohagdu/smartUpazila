<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AllTypeTitle;
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
        $if_exist_check_info = DB::table('upazila_basic_info')->where('introduction', '!=', NULL)->first();
         

        if($request->ajax()){
           $data = json_decode($if_exist_check_info->introduction);

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

        $all_type_info = AllTypeTitle::where('is_active','!=','0')
        ->where('type','=','1')
        ->get();

return view('upazila_related.upazilaIntroduction', compact('all_type_info'));

       
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
        


        $if_exist_check_info = DB::table('upazila_basic_info')->where('introduction', '!=', NULL)->first();

       // dd($if_exist_check_info);
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
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];

      

       // dd($upazila_basic_info_data);

        if (!empty($introduction_data_get)){
            $introduction_data_get[] =$introduction_info;

            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
            ////dd($upazila_basic_info_data);
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
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
          //  dd($upazila_basic_info_data);
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
        $if_exist_check_info = DB::table('upazila_basic_info')->where('introduction', '!=', NULL)->first();

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

        $if_exist_check_info = DB::table('upazila_basic_info')->where('introduction', '!=', NULL)->first();

        $introduction_data_get= !empty($if_exist_check_info->introduction)?json_decode($if_exist_check_info->introduction,true):NULl;

        //dd($exhibition_data);
         $key = array_search($request->introduction_id, array_column($introduction_data_get, 'id'));


         $introduction_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

         $introduction_info = [
            'id'               => $id,
            'title'            => $request->title,
            'description'      => $request->description,
            'display_position' => $request->display_position,
            'is_active'        => $request->is_active,
            'created_by'       => Auth::user()->id,
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];

        if (!empty($introduction_data_get)){
            $introduction_data_get[$key] = $introduction_info;

            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];
            //dd($upazila_basic_info_data);
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
         $id = $request->id;

         $if_exist_check_info = DB::table('upazila_basic_info')->where('introduction', '!=', NULL)->first();

        $introduction_data_get= !empty($if_exist_check_info->introduction)?json_decode($if_exist_check_info->introduction,true):NULl;

         $key = array_search($request->id, array_column($introduction_data_get, 'id'));


         $introduction_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;


        if (!empty($introduction_data_get)){
            
            unset($introduction_data_get[$key]);
        
            $upazila_basic_info_data = [
                'introduction'=> (!empty($introduction_data_get)? json_encode($introduction_data_get):NULL),
                'is_active'   => $request->is_active,
                'created_by'  => Auth::user()->id,
                'updated_by'  => NULL,
                'created_ip'  => request()->ip(),
                'updated_ip'  => NULL,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => NULL,
            ];

           
           // dd($upazila_basic_info_data);
            $data_delete = DB::table('upazila_basic_info')->where('id', '=', $introduction_id)->update($upazila_basic_info_data);

            return response()->json([
                'status' => $data_delete ? 'success' : 'error',
                'msg'    => $data_delete ? 'Successfully Delete' : 'Someting went wrong',
            ]);


        }    
    }


    //up_history
    public function up_history(){

        $if_exist_check_info = DB::table('upazila_basic_info')->where('history', '!=', NULL)->first();
        $data = !empty($if_exist_check_info->history) ? json_decode($if_exist_check_info->history) : NULL;

        $history =  !empty($data) ?  $data[0]->history : NULL;
        
        
        return view('upazila_related.up_history', compact('history'));
    }

    public function up_history_store(Request $request){

        $history = $request->history;

        $if_exist_check_info = DB::table('upazila_basic_info')->where('history', '!=', NULL)->first();

        $history_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

       

        $history_info[] = [
            'history'           => $history,
            'created_by'       => Auth::user()->id,
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];
        

            if(!empty($if_exist_check_info)){


                $upazila_basic_info_data = [
                    'history'=> (!empty($history_info)? json_encode($history_info):NULL),
                    'is_active'   =>1,
                    'created_by'  => Auth::user()->id,
                    'updated_by'  => NULL,
                    'created_ip'  => request()->ip(),
                    'updated_ip'  => NULL,
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => NULL,
                ];
                
                $data_save = DB::table('upazila_basic_info')->where('id', '=', $history_id)->update($upazila_basic_info_data);

                return redirect()->route('upazila_related.up_history')->with('message', 'Successfully Saved');   

            }else{

                $upazila_basic_info_data = [
                    'history'=> (!empty($history_info)? json_encode($history_info):NULL),
                    'is_active'   => 1,
                    'created_by'  => Auth::user()->id,
                    'updated_by'  => NULL,
                    'created_ip'  => request()->ip(),
                    'updated_ip'  => NULL,
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => NULL,
                ];
         
                $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

                return redirect()->route('upazila_related.up_history')->with('message', 'Successfully Save');   

            }

    }

    // upazila_geographical
    public function upazila_geographical(){

        $if_exist_check_info = DB::table('upazila_basic_info')->where('geographical_view', '!=', NULL)->first();
        $data = !empty($if_exist_check_info->geographical_view) ? json_decode($if_exist_check_info->geographical_view) : NULL;

        $geographical_view =  !empty($data) ?  $data[0]->geographical_view : NULL;
        
        
        return view('upazila_related.upazila_geographical', compact('geographical_view'));
    }

    public function upazila_geographical_store(Request $request){

        $geographical_view = $request->geographical_view;

        $if_exist_check_info = DB::table('upazila_basic_info')->where('geographical_view', '!=', NULL)->first();

        $geographical_view_id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

       

        $geographical_info[] = [
            'geographical_view'=> $geographical_view,
            'created_by'       => Auth::user()->id,
            'updated_by'       => NULL,
            'created_ip'       => request()->ip(),
            'updated_ip'       => NULL,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => NULL,
        ];
        

        if(!empty($if_exist_check_info)){


                $upazila_basic_info_data = [
                    'geographical_view'=> (!empty($geographical_info)? json_encode($geographical_info):NULL),
                    'is_active'        =>1,
                    'created_by'       => Auth::user()->id,
                    'updated_by'       => NULL,
                    'created_ip'       => request()->ip(),
                    'updated_ip'       => NULL,
                    'created_at'       => date('Y-m-d H:i:s'),
                    'updated_at'       => NULL,
                ];

                
                $data_save = DB::table('upazila_basic_info')->where('id', '=', $geographical_view_id)->update($upazila_basic_info_data);

                return redirect()->route('upazila_related.upazila_geographical')->with('message', 'Successfully Saved');   

            }else{

                $upazila_basic_info_data = [
                    'geographical_view'=> (!empty($geographical_info)? json_encode($geographical_info):NULL),
                    'is_active'   => 1,
                    'created_by'  => Auth::user()->id,
                    'updated_by'  => NULL,
                    'created_ip'  => request()->ip(),
                    'updated_ip'  => NULL,
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => NULL,
                ];

         
                $data_save = DB::table('upazila_basic_info')->insert($upazila_basic_info_data);

                return redirect()->route('upazila_related.upazila_geographical')->with('message', 'Successfully Save');   

            }

    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DcUnoChairmanInfo;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use DataTables;
use Session;
use DB;

class DcUnoChairmanController extends Controller
{
  
    public function index(Request $request)
    {
        if($request->ajax()){
            $information = DcUnoChairmanInfo::where('is_active','!=', 0);
                if ($request->division_id > 0) {
                $information->where('division_id', '=', $request->division_id);
                }
                if ($request->district_id > 0) {
                    $information->where('district_id', '=', $request->district_id);
                }
                if ($request->upazila_id > 0) {
                    $information->where('upazila_id', '=', $request->upazila_id);
                }
                if ($request->is_active > 0) {
                    $information->where('is_active', '=', $request->is_active);
                }
            $data = $information->where('type','=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('division_id',function($row){
                    return Division::find($row->division_id)->bn_name;
                 })
                 ->addColumn('district_id',function($row){
                    return District::find($row->district_id)->bn_name;
                 })
                 ->addColumn('upazila_id',function($row){
                    return Upazila::find($row->upazila_id)->bn_name;
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
                     
                        $html.='<button class="btn btn-primary btn-xs DcUnoChairmanEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs DcUnoChairmanDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>'; 

                    return $html;
                })
                ->rawColumns(['division_id','district_id','upazila_id','is_active','action'])
                ->make(true);
        }else{
            $division = Division::all();
            $district = District::all();
            $upazila  = Upazila::all();
            return view('dc_uno_chairman.dc', compact('division', 'district', 'upazila'));
        }
    }

  
    public function store(Request $request)
    {
        if((isset($request->dc_uno_chairman_id) && !empty($request->dc_uno_chairman_id)) ){
            $info = DcUnoChairmanInfo::find($request->dc_uno_chairman_id);
            $info->updated_by = Auth::user()->id;
            $info->updated_ip =  request()->ip();
            $info->updated_at = date('Y-m-d H:i:s');


        }else{

            $info = new DcUnoChairmanInfo();
            $info->created_by = Auth::user()->id;
            $info->created_ip =  request()->ip();
            $info->created_at = date('Y-m-d H:i:s');

        }

        $info->division_id = $request->division_id; 
        $info->district_id = $request->district_id;
        $info->upazila_id  = $request->upazila_id;
        $info->union_name  = $request->union_name;
        $info->name        = $request->name;
        $info->mobile      = $request->mobile;
        $info->email       = $request->email;
        $info->bcs_batch   = $request->bcs_batch;
        $info->address     = $request->address;
        $info->comment     = $request->comment;
        $info->type        = 1;
        $info->is_active   = $request->is_active;

        $isSave = $info->save();

        if((isset($request->dc_uno_chairman_id) && !empty($request->dc_uno_chairman_id)) ){
            return response()->json([
                'status' => $isSave ? 'success' : 'error',
                'msg'    => $isSave ? 'Successfully Updated' : 'Someting went wrong',
            ]);
        }else{
            return response()->json([
                'status' => $isSave ? 'success' : 'error',
                'msg'    => $isSave ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }
    }

    public function edit(Request $request)
    {
        $data =  DcUnoChairmanInfo::find($request->id);

        return response()->json([
            'status' => !empty($data) ? 'success' : 'error',
            'msg'    => !empty($data) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($data) ? $data : []
        ]);
    }
   
    public function destroy(Request $request)
    {
        $info = DcUnoChairmanInfo::find($request->id);
        $info->is_active  = 0;
        $info->updated_by = Auth::user()->id;
        $info->updated_ip =  request()->ip();
        $info->updated_at = date('Y-m-d H:i:s');

        $isDelete = $info->save();

        return response()->json([
            'status' => $isDelete ? 'success' : 'error',
            'msg'    => $isDelete ? 'Successfully Delete' : 'Someting went wrong',
        ]);

    }

    // uno info 
    public function uno_info(Request $request)
    {
        if($request->ajax()){
            $information = DcUnoChairmanInfo::where('is_active','!=', 0);
                if ($request->division_id > 0) {
                $information->where('division_id', '=', $request->division_id);
                }
                if ($request->district_id > 0) {
                    $information->where('district_id', '=', $request->district_id);
                }
                if ($request->upazila_id > 0) {
                    $information->where('upazila_id', '=', $request->upazila_id);
                }
                if ($request->is_active > 0) {
                    $information->where('is_active', '=', $request->is_active);
                }
            $data = $information->where('type','=', 2)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('division_id',function($row){
                    return Division::find($row->division_id)->bn_name;
                 })
                 ->addColumn('district_id',function($row){
                    return District::find($row->district_id)->bn_name;
                 })
                 ->addColumn('upazila_id',function($row){
                    return Upazila::find($row->upazila_id)->bn_name;
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
                     
                        $html.='<button class="btn btn-primary btn-xs DcUnoChairmanEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs DcUnoChairmanDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>'; 

                    return $html;
                })
                ->rawColumns(['division_id','district_id','upazila_id','is_active','action'])
                ->make(true);
        }else{
            $division = Division::all();
            $district = District::all();
            $upazila  = Upazila::all();
            return view('dc_uno_chairman.uno', compact('division', 'district', 'upazila'));
        }
    }

    public function uno_store(Request $request)
    {
        if((isset($request->dc_uno_chairman_id) && !empty($request->dc_uno_chairman_id)) ){
            $info = DcUnoChairmanInfo::find($request->dc_uno_chairman_id);
            $info->updated_by = Auth::user()->id;
            $info->updated_ip =  request()->ip();
            $info->updated_at = date('Y-m-d H:i:s');


        }else{

            $info = new DcUnoChairmanInfo();
            $info->created_by = Auth::user()->id;
            $info->created_ip =  request()->ip();
            $info->created_at = date('Y-m-d H:i:s');

        }

        $info->division_id = $request->division_id; 
        $info->district_id = $request->district_id;
        $info->upazila_id  = $request->upazila_id;
        $info->union_name  = $request->union_name;
        $info->name        = $request->name;
        $info->mobile      = $request->mobile;
        $info->email       = $request->email;
        $info->bcs_batch   = $request->bcs_batch;
        $info->address     = $request->address;
        $info->comment     = $request->comment;
        $info->type        = 2;
        $info->is_active   = $request->is_active;

        $isSave = $info->save();

        if((isset($request->dc_uno_chairman_id) && !empty($request->dc_uno_chairman_id)) ){
            return response()->json([
                'status' => $isSave ? 'success' : 'error',
                'msg'    => $isSave ? 'Successfully Updated' : 'Someting went wrong',
            ]);
        }else{
            return response()->json([
                'status' => $isSave ? 'success' : 'error',
                'msg'    => $isSave ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }
    }

    public function uno_edit(Request $request)
    {
        $data =  DcUnoChairmanInfo::find($request->id);

        return response()->json([
            'status' => !empty($data) ? 'success' : 'error',
            'msg'    => !empty($data) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($data) ? $data : []
        ]);
    }

    public function uno_destroy(Request $request)
    {
        $info = DcUnoChairmanInfo::find($request->id);
        $info->is_active  = 0;
        $info->updated_by = Auth::user()->id;
        $info->updated_ip =  request()->ip();
        $info->updated_at = date('Y-m-d H:i:s');

        $isDelete = $info->save();

        return response()->json([
            'status' => $isDelete ? 'success' : 'error',
            'msg'    => $isDelete ? 'Successfully Delete' : 'Someting went wrong',
        ]);
    }

     // Chairman info 
     public function chairman_info(Request $request)
     {
         if($request->ajax()){
            $information = DcUnoChairmanInfo::where('is_active','!=', 0);
                if ($request->division_id > 0) {
                $information->where('division_id', '=', $request->division_id);
                }
                if ($request->district_id > 0) {
                    $information->where('district_id', '=', $request->district_id);
                }
                if ($request->upazila_id > 0) {
                    $information->where('upazila_id', '=', $request->upazila_id);
                }
                if ($request->is_active > 0) {
                    $information->where('is_active', '=', $request->is_active);
                }
            $data = $information->where('type','=', 3)->get();
             return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('division_id',function($row){
                    return Division::find($row->division_id)->bn_name;
                 })
                 ->addColumn('district_id',function($row){
                    return District::find($row->district_id)->bn_name;
                 })
                 ->addColumn('upazila_id',function($row){
                    return Upazila::find($row->upazila_id)->bn_name;
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
                     
                        $html.='<button class="btn btn-primary btn-xs DcUnoChairmanEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs DcUnoChairmanDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>'; 

                    return $html;
                })
                ->rawColumns(['division_id','district_id','upazila_id','is_active','action'])
                ->make(true);
         }else{
             $division = Division::all();
             $district = District::all();
             $upazila  = Upazila::all();
             return view('dc_uno_chairman.chairman', compact('division', 'district', 'upazila'));
         }
     }

     public function chairman_store(Request $request)
    {
        if((isset($request->dc_uno_chairman_id) && !empty($request->dc_uno_chairman_id)) ){
            $info = DcUnoChairmanInfo::find($request->dc_uno_chairman_id);
            $info->updated_by = Auth::user()->id;
            $info->updated_ip =  request()->ip();
            $info->updated_at = date('Y-m-d H:i:s');
        }else{
            $info = new DcUnoChairmanInfo();
            $info->created_by = Auth::user()->id;
            $info->created_ip =  request()->ip();
            $info->created_at = date('Y-m-d H:i:s');
        }

        $info->division_id = $request->division_id; 
        $info->district_id = $request->district_id;
        $info->upazila_id  = $request->upazila_id;
        $info->union_name  = $request->union_name;
        $info->name        = $request->name;
        $info->mobile      = $request->mobile;
        $info->email       = $request->email;
        $info->address     = $request->address;
        $info->comment     = $request->comment;
        $info->type        = 3;
        $info->is_active   = $request->is_active;

        $isSave = $info->save();

        if((isset($request->dc_uno_chairman_id) && !empty($request->dc_uno_chairman_id)) ){
            return response()->json([
                'status' => $isSave ? 'success' : 'error',
                'msg'    => $isSave ? 'Successfully Updated' : 'Someting went wrong',
            ]);
        }else{
            return response()->json([
                'status' => $isSave ? 'success' : 'error',
                'msg'    => $isSave ? 'Successfully Added' : 'Someting went wrong',
            ]);
        }
    }

    public function chairman_edit(Request $request)
    {
        $data =  DcUnoChairmanInfo::find($request->id);

        return response()->json([
            'status' => !empty($data) ? 'success' : 'error',
            'msg'    => !empty($data) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($data) ? $data : []
        ]);
    }

    public function chairman_destroy(Request $request)
    {
        $info = DcUnoChairmanInfo::find($request->id);
        $info->is_active  = 0;
        $info->updated_by = Auth::user()->id;
        $info->updated_ip =  request()->ip();
        $info->updated_at = date('Y-m-d H:i:s');

        $isDelete = $info->save();

        return response()->json([
            'status' => $isDelete ? 'success' : 'error',
            'msg'    => $isDelete ? 'Successfully Delete' : 'Someting went wrong',
        ]);
    }

    // get district , upazila ingo
    public function get_district_info(Request $request){

       $response = District::where('division_id', '=', $request->division_id)->get();

       if (!empty($response)) {
            echo json_encode(['status' => 'success', "message" => "data found", 'data' => $response]);
        }else{
            echo json_encode(['status' => 'error', "message" => "data not found", 'data' => []]);
        }
    }

    public function get_upazila_info(Request $request){

        $response = Upazila::where('district_id', '=', $request->district_id)->get();
 
        if (!empty($response)) {
             echo json_encode(['status' => 'success', "message" => "data found", 'data' => $response]);
         }else{
             echo json_encode(['status' => 'error', "message" => "data not found", 'data' => []]);
         }
     }
}

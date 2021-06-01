<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Upazila;
use App\Models\UnionInfo;
use DataTables;
use DB;

class UnionInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $data = UnionInfo::where('is_active','!=','0')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('upazila_id',function($row){
                   return Upazila::find($row->upazila_id)->name;
                })
                ->addColumn('action',function($row){
                    $html = '';
                     
                        $html.='<button class="btn btn-info btn-sm UnionSetupEdit" data-id="'.$row->id.'">Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-sm UnionSetupDelete" data-id="'.$row->id.'">Delete</button>'; 

                    return $html;
                })
                ->rawColumns(['upazila_id','action'])
                ->make(true);
        }else{

            $upazila = Upazila::all();
            return view('union_setup', compact('upazila'));
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

        if((isset($request->union_info_id) && !empty($request->union_info_id)) ){
            $union_info = UnionInfo::find($request->union_info_id);
            $union_info->updated_by = Auth::user()->id;
            $union_info->updated_ip =  request()->ip();


        }else{

            $union_info = new UnionInfo();
            $union_info->created_by = Auth::user()->id;
            $union_info->created_ip =  request()->ip();

        }

        $union_info->upazila_id = $request->upazila_id;
        $union_info->union_name = $request->union_name;
        $union_info->union_code = $request->union_code;
        $union_info->web_url    = $request->web_url;
        $union_info->is_active  = $request->is_active;

        $isSave = $union_info->save();

        if((isset($request->union_info_id) && !empty($request->union_info_id)) ){

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
        $data =  UnionInfo::find($request->id);


        //  echo "<pre>";
        // print_r($data);exit;

        return response()->json([
            'status' => !empty($data) ? 'success' : 'error',
            'msg'    => !empty($data) ? 'Data Found' : 'Something went wrong',
            'data'   => !empty($data) ? $data : []
        ]);
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
    public function destroy(Request $request)
    {
        $id = $request->id;

        $union_info = [
            'is_active' => 0,
        ];

        $isDelete = DB::table('union_infos')->where('id', '=', $id)->update($union_info);

        return response()->json([
            'status' => $isDelete ? 'success' : 'error',
            'msg'    => $isDelete ? 'Successfully Delete' : 'Someting went wrong',
        ]);

    }
}

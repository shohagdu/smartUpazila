<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AllTypeTitle;
use DataTables;
use DB;

class AllTypeTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = AllTypeTitle::where('is_active','!=','0')->get();
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
                     
                        $html.='<button class="btn btn-primary btn-xs AllTypeTitleEdit" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-pencil"></i> Edit</button> &nbsp; &nbsp; <button class="btn btn-danger btn-xs AllTypeTitleDelete" data-id="'.$row->id.'"> <i class="glyphicon glyphicon-trash"></i> Delete</button>'; 

                    return $html;
                })
                ->rawColumns(['is_active','action'])
                ->make(true);
        }else{

            return view('all_type_title');
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
        if((isset($request->all_type_title_id) && !empty($request->all_type_title_id)) ){
            $all_type_title_info = AllTypeTitle::find($request->all_type_title_id);
            $all_type_title_info->updated_by = Auth::user()->id;
            $all_type_title_info->updated_ip =  request()->ip();


        }else{

            $all_type_title_info = new AllTypeTitle();
            $all_type_title_info->created_by = Auth::user()->id;
            $all_type_title_info->created_ip =  request()->ip();

        }
        $all_type_title_info->title            = $request->title;
        $all_type_title_info->display_position = $request->display_position;
        $all_type_title_info->type             = $request->type;
        $all_type_title_info->is_active        = $request->is_active;

        $isSave = $all_type_title_info->save();

        if((isset($request->all_type_title_id) && !empty($request->all_type_title_id)) ){

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
        $data =  AllTypeTitle::find($request->id);

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

        $all_type_titles_info = [
            'is_active' => 0,
        ];

        $isDelete = DB::table('all_type_titles')->where('id', '=', $id)->update($all_type_titles_info);

        return response()->json([
            'status' => $isDelete ? 'success' : 'error',
            'msg'    => $isDelete ? 'Successfully Delete' : 'Someting went wrong',
        ]);
    }
}

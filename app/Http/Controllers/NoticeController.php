<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notice;
use DataTables;
use Session;
use DB;


class NoticeController extends Controller
{
    public $notice_model;
    public function __construct()
    {
        $this->middleware('auth');
        $this->notice_model = new Notice();

    }
    
    public function index()
    {
        $get_notice = Notice::where('is_active', '!=', 0)->orderBy('id','DESC')->get();

       return view('notice.notice', compact('get_notice'));
    }

  
    public function create()
    {
        return view('notice.notice_create');
    }

   
    public function store(Request $request)
    {
       
        if(isset($request->attachment)){

            $attachmentName = 'attachment_'.time().'.'.$request->attachment->extension();  
  
            $request->attachment->move('img/attachment', $attachmentName);
  
            $attachment = $attachmentName;
  
          }else{
  
            $attachment = NULL;
  
          }

        $notice_info = [
            'title'          => $request->title,
            'description'    => $request->description,
            'attachment'     => $attachment,
            'view_order'     => $request->view_order,
            'type'          =>  $request->type,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('notices')->insert($notice_info);

        if($data_save){

            return redirect()->route('notice.index')->with('message', 'Successfully Save');   
        }


    }

  
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $get_notice = Notice::where('id', '=', $id)->first();

        return view('notice.notice_edit', compact('get_notice'));
    }

  
    public function update(Request $request, $id)
    {
        if(isset($request->attachment)){

            $attachmentName = 'attachment_'.time().'.'.$request->attachment->extension();  
  
            $request->attachment->move('img/attachment', $attachmentName);
  
            $attachment = $attachmentName;
  
          }else{
  
            $attachment = $request->pre_attachment;
  
          }

        $notice_info = [
            'title'          => $request->title,
            'description'    => $request->description,
            'attachment'     => $attachment,
            'view_order'     => $request->view_order,
            'type'           =>  $request->type,
            'is_active'      => $request->is_active,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('notices')->where('id','=',$id)->update($notice_info);

        if($data_save){

            return redirect()->route('notice.index')->with('message', 'Successfully Upddated');   
        }
    }

  
    public function destroy($id)
    {
        $notice_info = [
            'is_active'      => 0,
            'updated_by'     => Auth::user()->id,
            'updated_ip'     => request()->ip(),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('notices')->where('id','=',$id)->update($notice_info);

        if($data_save){

            return redirect()->route('notice.index')->with('message', 'Successfully Delete');   
        }
    }

    public function search(Request $request){
            $type   = $request->type;
            $status = $request->is_active;

            $query = DB::table('notices')->where('is_active', '!=', 0)->orderBy('id', 'DESC');

            if($type !=''){
                $query->Where("type", "=", $type);
            }
            if($status !=''){
                $query->Where("is_active", "=", $status);
            }

            $get_notice = $query->get();

            return view('notice.notice', compact('get_notice'));

    }

}

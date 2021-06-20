<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DynamicContentPage;
use DataTables;
use Session;
use DB;

class DynamicContentPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $dynamic_content_page_info = DynamicContentPage::where('is_active', '!=', 0)->get();

        return view('dynamic_content_page.dynamic_content_page', compact('dynamic_content_page_info'));
    }

    public function create()
    {
        return view('dynamic_content_page.dynamic_content_page_create');
    }

   
    public function store(Request $request)
    {
        if(isset($request->image)){

            $imageName = 'dynamic_content_page_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/dynamic_content_page', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $people_info = [
            'title'        => $request->title,
            'url_path'     => $request->url_path,
            'remarks'      => $request->remarks,
            'details'      => $request->details,
            'attachment'   => $image,
            'is_active'    => $request->is_active,
            'created_by'   => Auth::user()->id,
            'created_ip'   => request()->ip(),
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('dynamic_content_page')->insert($people_info);

        if($data_save){
            
              return redirect()->route('dynamic_content_page.index')->with('message', 'Successfully Save');  

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
    public function edit($id)
    {
        $info = DynamicContentPage::find($id);

        return view('dynamic_content_page.dynamic_content_page_edit', compact('info'));
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
        if(isset($request->image)){

            $imageName = 'dynamic_content_page_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/dynamic_content_page', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->pre_image;
  
          }

        $people_info = [
            'title'        => $request->title,
            'url_path'     => $request->url_path,
            'remarks'      => $request->remarks,
            'details'      => $request->details,
            'attachment'   => $image,
            'is_active'    => $request->is_active,
            'updated_by'   => Auth::user()->id,
            'updated_ip'   => request()->ip(),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('dynamic_content_page')->where('id','=',$id)->update($people_info);

        if($data_save){
            
              return redirect()->route('dynamic_content_page.index')->with('message', 'Successfully Updated');  

        }
    }

    public function destroy($id)
    {
        $people_info = [
            'is_active'    => 0,
            'updated_by'   => Auth::user()->id,
            'updated_ip'   => request()->ip(),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $data_delete = DB::table('dynamic_content_page')->where('id','=',$id)->update($people_info);

        if($data_delete){
            
              return redirect()->route('dynamic_content_page.index')->with('message', 'Successfully Delete');  

        }
    }
}

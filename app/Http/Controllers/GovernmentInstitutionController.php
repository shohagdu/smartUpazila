<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AllTypeTitle;
use DataTables;
use Session;
use DB;


class GovernmentInstitutionController extends Controller
{
    public function low_and_order(Request $request)
    {

         $low_and_order_info = DB::table('institutions')->where('type', '=', 4)->where('is_active', '!=', 0)->get();


        return view('government_institution.low_and_order', compact('low_and_order_info'));
    }

    public function low_and_order_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',4)
                                ->get();

                             
        return view('government_institution.low_and_order_create', compact('type_info'));
    }

    public function low_and_order_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'government_institution_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/government_institution', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $institution_info = [
            'title'           => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'designation'    => $request->designation,
            'type'           => 4,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('pourosova_related.low_and_order')->with('message', 'Successfully Save');  

        }

    }


    public function low_and_order_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=',4)
                        ->get();

         $low_and_order_info = DB::table('institutions')->where('type', '=', 4)->where('id', '=', $id)->first();


         return view('government_institution.low_and_order_edit', compact('type_info','low_and_order_info'));
    }


    public function low_and_order_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'government_institution_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/government_institution', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->image;
  
          }

        $institution_info = [
            'title'           => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'designation'    => $request->designation,
            'type'           => 4,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('pourosova_related.low_and_order')->with('message', 'Successfully Updated');  

        }
    }

    public function low_and_order_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('pourosova_related.low_and_order')->with('message', 'Successfully Delete');  

        }
    }

    // health issue

    public function health_issues(Request $request)
    {

         $health_issues_info = DB::table('institutions')->where('type', '=', 5)->where('is_active', '!=', 0)->get();


        return view('government_institution.health_issues', compact('health_issues_info'));
    }

    public function health_issues_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',5)
                                ->get();

                             
        return view('government_institution.health_issues_create', compact('type_info'));
    }

    public function health_issues_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'health_issues'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/health_issues', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $institution_info = [
            'title'           => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'designation'    => $request->designation,
            'address'        => $request->address,
            'type'           => 5,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.health_issues')->with('message', 'Successfully Save');  

        }
    }

    
    public function health_issues_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=',5)
                        ->get();

         $data = DB::table('institutions')->where('type', '=', 5)->where('id', '=', $id)->first();


         return view('government_institution.health_issues_edit', compact('type_info','data'));
    }

    public function health_issues_update(Request $request, $id)
    {

        if(isset($request->image)){

            $imageName = 'health_issues'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/health_issues', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->image;
  
          }

        $institution_info = [
            'title'           => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'designation'    => $request->designation,
            'address'        => $request->address,
            'type'           => 5,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id','=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.health_issues')->with('message', 'Successfully Save');  

        }
    }

    public function health_issues_delete($id)
    {
        
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id','=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.health_issues')->with('message', 'Successfully Deleted');  

        }
    }

    // agriculture_and_food

    public function agriculture_and_food(Request $request)
    {

         $agriculture_and_food_info = DB::table('institutions')->where('type', '=', 6)->where('is_active', '!=', 0)->get();


        return view('government_institution.agriculture_and_food', compact('agriculture_and_food_info'));
    }

    public function agriculture_and_food_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',6)
                                ->get();

                             
        return view('government_institution.low_and_order_create', compact('type_info'));
    }

    public function agriculture_and_food_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'agriculture_and_food_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/agriculture_and_food', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $institution_info = [
            'title'           => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'designation'    => $request->designation,
            'type'           => 6,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.agriculture_and_food')->with('message', 'Successfully Save');  

        }

    }


    public function agriculture_and_food_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=',6)
                        ->get();

         $low_and_order_info = DB::table('institutions')->where('type', '=', 6)->where('id', '=', $id)->first();


         return view('government_institution.agriculture_and_food_edit', compact('type_info','low_and_order_info'));
    }


    public function agriculture_and_food_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'government_institution_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/government_institution', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->image;
  
          }

        $institution_info = [
            'title'           => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'designation'    => $request->designation,
            'type'           => 6,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.agriculture_and_food')->with('message', 'Successfully Updated');  

        }
    }

    public function agriculture_and_food_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.agriculture_and_food')->with('message', 'Successfully Delete');  

        }
    }
}

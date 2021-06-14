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
            
              return redirect()->route('government_institution.health_issues')->with('message', 'Successfully Update');  

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

         $info = DB::table('institutions')->where('type', '=', 6)->where('id', '=', $id)->first();


         return view('government_institution.agriculture_and_food_edit', compact('type_info','info'));
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

    // land_matters

    public function land_matters()
    {

         $land_matters = DB::table('institutions')->where('type', '=', 9)->where('is_active', '!=', 0)->get();

        return view('government_institution.land_matters', compact('land_matters'));
    }

    public function land_matters_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',9)
                                ->get();
                             
        return view('government_institution.land_matters_create', compact('type_info'));
    }

    public function land_matters_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'land_matters_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/land_matters', $imageName);
  
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
            'type'           => 9,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.land_matters')->with('message', 'Successfully Save');  

        }

    }


    public function land_matters_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=',9)
                        ->get();

         $info = DB::table('institutions')->where('type', '=', 9)->where('id', '=', $id)->first();


         return view('government_institution.land_matters_edit', compact('type_info','info'));
    }


    public function land_matters_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'land_matters_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/land_matters', $imageName);
  
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
            'type'           => 9,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.land_matters')->with('message', 'Successfully Updated');  

        }
    }

    public function land_matters_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.land_matters')->with('message', 'Successfully Delete');  

        }
    }

    // govt_engineers

    public function govt_engineers()
    {

         $govt_engineers = DB::table('institutions')->where('type', '=', 10)->where('is_active', '!=', 0)->get();

        return view('government_institution.govt_engineers', compact('govt_engineers'));
    }

    public function govt_engineers_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',10)
                                ->get();
                             
        return view('government_institution.govt_engineers_create', compact('type_info'));
    }

    public function govt_engineers_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'govt_engineers_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/govt_engineers', $imageName);
  
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
            'type'           => 10,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.govt_engineers')->with('message', 'Successfully Save');  

        }

    }


    public function govt_engineers_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=',10)
                        ->get();

         $info = DB::table('institutions')->where('type', '=', 10)->where('id', '=', $id)->first();


         return view('government_institution.govt_engineers_edit', compact('type_info','info'));
    }


    public function govt_engineers_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'govt_engineers_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/govt_engineers', $imageName);
  
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
            'type'           => 10,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.govt_engineers')->with('message', 'Successfully Updated');  

        }
    }

    public function govt_engineers_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.govt_engineers')->with('message', 'Successfully Delete');  

        }
    }

    // educational institutions

    public function educational_institutions()
    {

         $educational_institutions = DB::table('institutions')->where('type', '=', 11)->where('is_active', '!=', 0)->get();

        return view('government_institution.educational_institutions', compact('educational_institutions'));
    }

    public function educational_institutions_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',11)
                                ->get();
                             
        return view('government_institution.educational_institutions_create', compact('type_info'));
    }

    public function educational_institutions_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'educational_institutions_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/educational_institutions', $imageName);
  
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
            'type'           => 11,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.educational_institutions')->with('message', 'Successfully Save');  

        }

    }


    public function educational_institutions_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=',11)
                        ->get();

         $info = DB::table('institutions')->where('type', '=', 11)->where('id', '=', $id)->first();


         return view('government_institution.educational_institutions_edit', compact('type_info','info'));
    }


    public function educational_institutions_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'educational_institutions_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/educational_institutions', $imageName);
  
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
            'type'           => 11,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.educational_institutions')->with('message', 'Successfully Updated');  

        }
    }

    public function educational_institutions_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.educational_institutions')->with('message', 'Successfully Delete');  

        }
    }

    // non_govt organizations

    public function non_govt_organizations()
    {

         $non_govt_organizations = DB::table('institutions')->where('type', '=', 12)->where('is_active', '!=', 0)->get();

        return view('government_institution.non_govt_organizations', compact('non_govt_organizations'));
    }

    public function non_govt_organizations_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',12)
                                ->get();
                             
        return view('government_institution.non_govt_organizations_create', compact('type_info'));
    }

    public function non_govt_organizations_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'non_govt_organizations_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/non_govt_organizations', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $institution_info = [
            'title'          => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'address'        => $request->address,
            'type'           => 12,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.non_govt_organizations')->with('message', 'Successfully Save');  

        }

    }


    public function non_govt_organizations_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=', 12)
                        ->get();

         $info = DB::table('institutions')->where('type', '=', 12)->where('id', '=', $id)->first();


         return view('government_institution.non_govt_organizations_edit', compact('type_info','info'));
    }


    public function non_govt_organizations_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'non_govt_organizations_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/non_govt_organizations', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->image;
  
          }

        $institution_info = [
            'title'          => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'address'        => $request->address,
            'type'           => 12,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.non_govt_organizations')->with('message', 'Successfully Updated');  

        }
    }

    public function non_govt_organizations_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.non_govt_organizations')->with('message', 'Successfully Delete');  

        }
    }

    // religious institutions 

    public function religious_institutions()
    {

         $religious_institutions = DB::table('institutions')->where('type', '=', 13)->where('is_active', '!=', 0)->get();

        return view('government_institution.religious_institutions', compact('religious_institutions'));
    }

    public function religious_institutions_create()
    {
        $type_info = AllTypeTitle::where('is_active','!=',0)
                                ->where('type','=',13)
                                ->get();
                             
        return view('government_institution.non_govt_organizations_create', compact('type_info'));
    }

    public function religious_institutions_store(Request $request)
    {

        if(isset($request->image)){

            $imageName = 'religious_institutions_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/religious_institutions', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = NULL;
  
          }

        $institution_info = [
            'title'          => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'address'        => $request->address,
            'type'           => 13,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->insert($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.religious_institutions')->with('message', 'Successfully Save');  

        }

    }


    public function religious_institutions_edit($id)
    {
        
        $type_info = AllTypeTitle::where('is_active','!=',0)
                        ->where('type','=', 13)
                        ->get();

         $info = DB::table('institutions')->where('type', '=', 13)->where('id', '=', $id)->first();


         return view('government_institution.religious_institutions_edit', compact('type_info','info'));
    }


    public function religious_institutions_update (Request $request, $id)
    {
        
        if(isset($request->image)){

            $imageName = 'religious_institutions_'.time().'.'.$request->image->extension();  
  
            $request->image->move('img/religious_institutions', $imageName);
  
            $image = $imageName;
  
          }else{
  
            $image = $request->image;
  
          }

        $institution_info = [
            'title'          => $request->title,
            'name'           => $request->name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'address'        => $request->address,
            'type'           => 13,
            'image'          => $image,
            'view_order'     => $request->view_order,
            'is_active'      => $request->is_active,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.religious_institutions')->with('message', 'Successfully Updated');  

        }
    }

    public function religious_institutions_delete ($id)
    {
        $institution_info = [
            'is_active'      => 0,
            'created_by'     => Auth::user()->id,
            'created_ip'     => request()->ip(),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $data_save = DB::table('institutions')->where('id', '=', $id)->update($institution_info);

        if($data_save){
            
              return redirect()->route('government_institution.religious_institutions')->with('message', 'Successfully Delete');  

        }
    }
}

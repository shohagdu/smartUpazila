<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FooterArea;
use DataTables;
use Session;
use DB;

class FooterAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $if_exist_check_info = FooterArea::where('is_active', '!=', 0)->first();

        $privacy_policy_info = !empty($if_exist_check_info->privacy_policy) ? json_decode($if_exist_check_info->privacy_policy) : NULL;
        $terms_of_use_info = !empty($if_exist_check_info->terms_of_use) ? json_decode($if_exist_check_info->terms_of_use) : NULL;
        $in_overall_cooperation_info = !empty($if_exist_check_info->in_overall_cooperation) ? json_decode($if_exist_check_info->in_overall_cooperation) : NULL;
        $sitemap_info = !empty($if_exist_check_info->sitemap) ? json_decode($if_exist_check_info->sitemap) : NULL;
        $commonly_asked_info = !empty($if_exist_check_info->commonly_asked) ? json_decode($if_exist_check_info->commonly_asked) : NULL;


        return view('footer_area.footer_area', compact('privacy_policy_info', 'terms_of_use_info', 'in_overall_cooperation_info', 'sitemap_info', 'commonly_asked_info'));
    }

    public function privacy_policy()
    {
        $if_exist_check_info = FooterArea::where('privacy_policy', '!=', NULL)->first();

        $data = !empty($if_exist_check_info->privacy_policy) ? json_decode($if_exist_check_info->privacy_policy) : NULL;

        $info =  !empty($data) ?  $data->privacy_policy : NULL;

        return view('footer_area.privacy_policy', compact('info'));
    }
    public function privacy_policy_store(Request $request)
    {
        $if_exist_check_info = FooterArea::where('is_active', '=', 1)->count();


        $info = [
            'privacy_policy'  => $request->privacy_policy,
            'is_active'       => 1,
            'created_by'      => Auth::user()->id,
            'created_ip'      => request()->ip(),
            'created_at'      => date('Y-m-d H:i:s'),
        ];;

        if($if_exist_check_info >  0){
        

            $basic_info_data = [
                'privacy_policy'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE ):NULL),
                'is_active'   =>1,
                'updated_by'  => Auth::user()->id,
                'updated_ip'  => request()->ip(),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];


            $response = DB::table('footer_areas')->where('is_active', '=', '1')->update($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Updated');
            }

        }else{

            $basic_info_data = [
                'privacy_policy'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'     => 1,
                'created_by'    => Auth::user()->id,
                'created_ip'   => request()->ip(),
                'created_at'   => date('Y-m-d H:i:s'),
            ];

            $response = DB::table('footer_areas')->insert($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Saved');
            }

        }
    }

    public function terms_of_use()
    {
        $if_exist_check_info = FooterArea::where('terms_of_use', '!=', NULL)->first();

        $data = !empty($if_exist_check_info->terms_of_use) ? json_decode($if_exist_check_info->terms_of_use) : NULL;

        $info =  !empty($data) ?  $data->terms_of_use : NULL;

        return view('footer_area.terms_of_use', compact('info'));
    }

    public function terms_of_use_store(Request $request)
    {
        $if_exist_check_info = FooterArea::where('is_active', '=', 1)->count();

        $id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $info = [
            'terms_of_use'    => $request->terms_of_use,
            'is_active'       => 1,
            'created_by'      => Auth::user()->id,
            'created_ip'      => request()->ip(),
            'created_at'      => date('Y-m-d H:i:s'),
        ];


        if($if_exist_check_info > 0 ){

            $basic_info_data = [
                'terms_of_use'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE ):NULL),
                'is_active'   => 1,
                'updated_by'  => Auth::user()->id,
                'updated_ip'  => request()->ip(),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];


            $response = DB::table('footer_areas')->where('is_active', '=', 1)->update($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Updated');
            }

        }else{

            $basic_info_data = [
                'terms_of_use'  => (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'     => 1,
                'created_by'    => Auth::user()->id,
                'created_ip'    => request()->ip(),
                'created_at'    => date('Y-m-d H:i:s'),
            ];

            $response = DB::table('footer_areas')->insert($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Saved');
            }

        }

    }

    public function in_overall_cooperation()
    {
        $if_exist_check_info = FooterArea::where('in_overall_cooperation', '!=', NULL)->first();

        $data = !empty($if_exist_check_info->in_overall_cooperation) ? json_decode($if_exist_check_info->in_overall_cooperation) : NULL;

        $info =  !empty($data) ?  $data->in_overall_cooperation : NULL;

        return view('footer_area.in_overall_cooperation', compact('info'));
    }

    public function in_overall_cooperation_store(Request $request)
    {
        $if_exist_check_info = FooterArea::where('is_active', '=', 1)->count();

        $id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $info = [
            'in_overall_cooperation'=> $request->in_overall_cooperation,
            'is_active'             => 1,
            'created_by'            => Auth::user()->id,
            'created_ip'            => request()->ip(),
            'created_at'            => date('Y-m-d H:i:s'),
        ];


        if($if_exist_check_info > 0 ){

            $basic_info_data = [
                'in_overall_cooperation'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE ):NULL),
                'is_active'             =>1,
                'updated_by'            => Auth::user()->id,
                'updated_ip'            => request()->ip(),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];


            $response = DB::table('footer_areas')->where('is_active', '=', 1)->update($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Updated');
            }

        }else{

            $basic_info_data = [
                'in_overall_cooperation'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'             => 1,
                'created_by'            => Auth::user()->id,
                'created_ip'            => request()->ip(),
                'created_at'            => date('Y-m-d H:i:s'),
            ];

            $response = DB::table('footer_areas')->insert($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Saved');
            }

        }
    }
    public function sitemap()
    {
        $if_exist_check_info = FooterArea::where('sitemap', '!=', NULL)->first();

        $data = !empty($if_exist_check_info->sitemap) ? json_decode($if_exist_check_info->sitemap) : NULL;

        $info =  !empty($data) ?  $data->sitemap : NULL;

        return view('footer_area.sitemap', compact('info'));
    }

    public function sitemap_store(Request $request)
    {
        $if_exist_check_info = FooterArea::where('is_active', '=', 1)->count();

        $id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $info = [
            'sitemap'    => $request->sitemap,
            'is_active'  => 1,
            'created_by' => Auth::user()->id,
            'created_ip' => request()->ip(),
            'created_at' => date('Y-m-d H:i:s'),
        ];


        if(!empty($if_exist_check_info)){

            $basic_info_data = [
                'sitemap'     => (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE ):NULL),
                'is_active'   =>1,
                'updated_by'  => Auth::user()->id,
                'updated_ip'  => request()->ip(),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];


            $response = DB::table('footer_areas')->where('is_active', '=', 1)->update($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Updated');
            }

        }else{

            $basic_info_data = [
                'sitemap'     => (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'   => 1,
                'created_by'  => Auth::user()->id,
                'created_ip'  => request()->ip(),
                'created_at'  => date('Y-m-d H:i:s'),
            ];

            $response = DB::table('footer_areas')->insert($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Saved');
            }
        }
    }

    public function commonly_asked()
    {
        $if_exist_check_info = FooterArea::where('commonly_asked', '!=', NULL)->first();

        $data = !empty($if_exist_check_info->commonly_asked) ? json_decode($if_exist_check_info->commonly_asked) : NULL;

        $info =  !empty($data) ?  $data->commonly_asked : NULL;

        return view('footer_area.commonly_asked', compact('info'));
    }

    public function commonly_asked_store(Request $request)
    {
        $if_exist_check_info = FooterArea::where('is_active', '=', 1)->count();

        $id  = !empty($if_exist_check_info->id) ? $if_exist_check_info->id : 0;

        $info = [
            'commonly_asked'  => $request->commonly_asked,
            'is_active'       => 1,
            'created_by'      => Auth::user()->id,
            'created_ip'      => request()->ip(),
            'created_at'      => date('Y-m-d H:i:s'),
        ];


        if($if_exist_check_info > 0){

            $basic_info_data = [
                'commonly_asked'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE ):NULL),
                'is_active'     =>1,
                'updated_by'    => Auth::user()->id,
                'updated_ip'    => request()->ip(),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];


            $response = DB::table('footer_areas')->where('is_active', '=', 1)->update($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Updated');
            }

        }else{

            $basic_info_data = [
                'commonly_asked'=> (!empty($info)? json_encode($info, JSON_UNESCAPED_UNICODE):NULL),
                'is_active'     => 1,
                'created_by'    => Auth::user()->id,
                'created_ip'    => request()->ip(),
                'created_at'    => date('Y-m-d H:i:s'),
            ];

            $response = DB::table('footer_areas')->insert($basic_info_data);

            if($response){

                return redirect()->route('footer_area.index')->with('message', 'Successfully Saved');
            }

        }

    }
}

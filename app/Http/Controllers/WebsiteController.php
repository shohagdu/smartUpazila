<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UnionInfo;
use App\Models\Upazila_basic_info;
use App\Models\AllTypeTitle;
use App\Feature;
use PDF;
use Session;
use Image;


class WebsiteController extends Controller
{
    // home
    public function index()
    {
        $title='Home :: Upazila';
        $allUnionList=$union_info = UnionInfo::where(['is_active'=>1])->get();
        return view('subpage.homeContend',['title'=>$title,'unionList'=>$allUnionList]);
    }
// upzila sompirkota page
     public function up_introduce()
    {
        $title='উপজেলা সম্পর্কিত তথ্য :: Upazila';
        $data=Upazila_basic_info::where(['is_active'=>1])->select('introduction')->whereNotNull('introduction')->orderBy('id')->first();
        $info=(!empty($data->introduction)?json_decode($data->introduction,true):'');
        $settingInfo=AllTypeTitle::where(['type'=>1])->pluck('title','id');
        return view('subpage.upzila_introduce',['title'=>$title,'data'=>$info,'settingInfo'=>$settingInfo]);
    }
      public function up_history()
    {
        $title=' উপজেলার ঐতিহ্য  :: Upazila';
        $data=Upazila_basic_info::where(['is_active'=>1])->select('history')->whereNotNull('history')->orderBy('id')->first();
        $info=(!empty($data->history)?json_decode($data->history,true):'');
        return view('subpage.upazila_history',['title'=>$title,'data'=>(!empty($info[0])?$info[0]:'')]);
    }
      public function up_geographical()
    {
        $field='geographical_view';
        $title=' ভৌগলিক ও অর্থনৈতিক  :: Upazila';
        $data=Upazila_basic_info::where(['is_active'=>1])->select($field)->whereNotNull($field)->orderBy('id')->first();
        $info=(!empty($data->$field)?json_decode($data->$field,true):'');
        return view('subpage.Geographical',['title'=>$title,'data'=>(!empty($info)?$info:'')]);
    }
      public function up_public_represtative()
    {
        $field='representative_upazila_organogram';
        $title=' জনপ্রতিনিধিগণের তালিকা  :: Upazila';
        $data=Upazila_basic_info::where(['is_active'=>1])->select($field)->whereNotNull($field)->orderBy('id')->first();
        $info=(!empty($data->$field)?json_decode($data->$field,true):'');
        $info_new = array_filter($info, function ($var) {
            return ($var['is_active'] == 1);
        });
        return view('subpage.Public_representative',['title'=>$title,'data'=>(!empty($info_new)?$info_new:'')]);
    }
      public function up_fridomfighter()
    {
        $field='freedom_fighter';
        $title=' মুক্তিযোদ্ধাদের তালিকা  :: Upazila';
        $data=Upazila_basic_info::where(['is_active'=>1])->select($field)->whereNotNull($field)->orderBy('id')->first();
        $info=(!empty($data->$field)?json_decode($data->$field,true):'');
        $info_new = array_filter($info, function ($var) {
            return ($var['is_active'] == 1);
        });
        return view('subpage.fridomfighter',['title'=>$title,'data'=>(!empty($info_new)?$info_new:'')]);
    }

    // upzila porisad
  public function up_chirman()
    {
        $field='upazila_chairman';
        $title=' উপজেলা চেয়ারম্যান  :: Upazila';
        $data=Upazila_basic_info::where(['is_active'=>1])->select($field)->whereNotNull($field)->orderBy('id')->first();
        $info=(!empty($data->$field)?json_decode($data->$field,true):'');
        $info_new = array_filter($info, function ($var) {
            return ($var['is_active'] == 1);
        });
        return view('subpage.upzila_chirman',['title'=>$title,'data'=>(!empty($info_new)?$info_new:'')]);

    }
     public function up_vais_chirman()
    {
        return view('subpage.upzilavais_chirman');
    }
         public function up_mohilavais_chirman()
    {
        return view('subpage.mohilavais_chirman');
    }
         public function up_frakton_chirman()
    {
        return view('subpage.frakton_chirman');
    }
         public function up_karjobal()
    {
        return view('subpage.upzila_karjaboli');
    }
           public function up_sangotonik_katamo()
    {
        return view('subpage.upzila_sangotonik_katamo');
    }
// pourosova
    public function pourosova()
    {
        return view('subpage.pourosova');
    }

    public function mayor()
    {
        return view('subpage.mayor');
    }

     public function councilor()
    {
        return view('subpage.councilor');
    }

     public function pourosova_word()
    {
        return view('subpage.pourosova_word');
    }

     public function kormokorta()
    {
        return view('subpage.pourosova_kormokorta');
    }

     public function citizen_serzer()
    {
        return view('subpage.pourosova_citizen_serzen');
    }

     public function kormocari()
    {
        return view('subpage.pourosova_kormocari');
    }

     public function sangotonik_katamo()
    {
        return view('subpage.sangotonik_katamo_pourosova');
    }

     // government office
     public function low_and_order()
    {
        return view('subpage.law_and_order');
    }

     public function health_issues()
    {
        return view('subpage.health_issues');
    }

     public function agriculture_and_food()
    {
        return view('subpage.agriculture_and_food');
    }

     public function land_matters()
    {
        return view('subpage.land_matters');
    }

     public function gov_engineers()
    {
        return view('subpage.gov_engineers');
    }
   // ornanno page
       public function educational_institutions()
    {
        return view('subpage.educational_Institutions');
    }

       public function non_govern_organizations()
    {
        return view('subpage.non_governmental_organizations');
    }

       public function religious_institutions()
    {
        return view('subpage.religious_institutions');
    }


    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }


}

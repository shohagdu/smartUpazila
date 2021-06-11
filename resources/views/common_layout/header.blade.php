<?php
use App\Models\UnionInfo;
$allUnionListData=$union_info = UnionInfo::where(['is_active'=>1])->get();
?>
<section id="top_header_wrapper">
  <div class="container head_bg page_shadow">  <!-- container start -->
  <div class="row">  <!-- row start -->
  <div class="col-md-5 col-6 cus_col ">  <!-- col-md-7 start-->
      <div class="dropdown text-left">  <!-- dropdown start -->
          <a class="btn cus_btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ইউনিয়ন
          </a>
          <div class="dropdown-menu cus_dropdown" aria-labelledby="dropdownMenuLink">
              @if(!empty($allUnionListData))
                  @foreach($allUnionListData as $union)
                    <a class="dropdown-item cus_dropdowm_iteam" href="{{ (!empty($union->web_url)?$union->web_url:'') }}" target="blank">{{ (!empty($union->union_name)?$union->union_name:'') }}</a>
                  @endforeach
              @endif
          </div>
      </div> <!-- dropdown start -->
  </div>  <!-- col-md-7 end-->
  <div class="col-md-3 col-6  slogan cus_col" style="padding-top:3px "> <!-- col-md-2 start-->
      <h4>নাটোর সদর উপজেলা</h4>
  </div> <!-- col-md-2 end-->
  <div class="col-md-4 d-md-block d-none cus_col"> <!-- col-md-3 start-->
  <div class="icon_wrap"> <!-- icon_wrap start -->
  <ul class="list-inline">
    <li class="list-inline-item">
      <a href="#">
        <i class="fa fa-facebook"></i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#">
        <i class="fa fa-twitter"></i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#">
        <i class="fa fa-youtube"></i>
      </a>
    </li>
    <li class="list-inline-item">
      <a href="#">
        <i class="fa fa-envelope"></i>
      </a>
    </li>

  </ul>
  </div> <!-- icon_wrap end -->
  </div> <!-- col-md-3 end-->
  </div> <!-- row end -->
  </div> <!-- container end -->
  </section> <!--top header area end-->
  <!-- menu area start -->
  <section id="menu_wrapper">
    <div class="container page_shadow"> <!-- container start -->
    <nav class="navbar navbar-expand-lg navbar-light cus_nav"> <!-- navbar start -->
    <!-- toggle button start -->
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button> <!-- toggle button end -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent"> <!-- navbar-collapse start -->
    <ul class="navbar-nav "> <!-- navbar ul start -->
    <li class="nav-item active">
      <a class="nav-link" href=" {{url('/')}} "> <i class="fa fa-home"></i> প্রথম পাতা</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        উপজেলা সম্পর্কিত
      </a>
      <div class="dropdown-menu cus_dropdown_menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{url('/up_introduce')}}">উপজেলা পরিচিতি</a>
        <a class="dropdown-item" href="{{url('/up_history')}}">ইতিহাস ঐতিহ্য</a>
        <a class="dropdown-item" href="{{url('/up_geographical')}}">ভৌগলিক ও অর্থনৈতিক</a>
        <a class="dropdown-item" href="{{url('/up_public_represtative')}}">জনপ্রতিনিধিগণের তালিকা</a>
        <a class="dropdown-item" href="{{url('/up_fridomfighter')}}">মুক্তিযোদ্ধাদের তালিকা</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        উপজেলা পরিষদ
      </a>
      <div class="dropdown-menu cus_dropdown_menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href=" {{url('/up_chirman')}} ">চেয়ারম্যান, উপজেলা পরিষদ</a>
        <a class="dropdown-item" href=" {{url('/up_vais_chirman')}} ">ভাইস চেয়ারম্যান</a>
        <a class="dropdown-item" href=" {{url('/up_mohilavais_chirman')}} ">মহিলা ভাইস চেয়ারম্যান</a>
        <a class="dropdown-item" href=" {{url('/up_frakton_chirman')}} ">প্রাক্তন পরিষদ চেয়ারম্যানগণ</a>
        <a class="dropdown-item" href=" {{url('/up_karjobal')}} ">উপজেলা পরিষদের কার্যাবল</a>
        <a class="dropdown-item" href=" {{url('/up_sangotonik_katamo')}} ">সাংগঠনিক কাঠাম</a>
      </div>
    </li>
    <li class="nav-item dropdown ">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        ইউনিয়ন সম্পর্কিত
      </a>
      <div class="dropdown-menu cus_dropdown_menu" aria-labelledby="navbarDropdown">
          @if(!empty($allUnionListData))
              @foreach($allUnionListData as $union)
                <a class="dropdown-item" target="_blank" href="{{ (!empty($union->web_url)?$union->web_url:'') }}">{{ (!empty($union->union_name)?$union->union_name:'') }}</a>
              @endforeach
          @endif
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          পৌরসভা সম্পর্কিত
      </a>
      <div class="dropdown-menu cus_dropdown_menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href=" {{url('/pourosova')}} ">এক নজরে পৌরসভা</a>
        <a class="dropdown-item" href=" {{url('/mayor')}} ">মেয়র</a>
        <a class="dropdown-item" href=" {{url('/councilor')}} ">কাউন্সিলরগণ</a>
        <a class="dropdown-item" href=" {{url('/pourosova_word')}} ">ওয়ার্ড সমূহ</a>
        <a class="dropdown-item" href=" {{url('/kormokorta')}} ">কর্মকর্তাবৃন্দ</a>
        <a class="dropdown-item" href=" {{url('/citizen_serzer')}} ">সিটিজেন চার্টার</a>
        <a class="dropdown-item" href=" {{url('/kormocari')}} ">কর্মচারীবৃন্দ</a>
        <a class="dropdown-item" href=" {{url('/sangotonik_katamo')}} ">সাংগঠনিক কাঠাম</a>
        <a class="dropdown-item" href="http://bdlaws.minlaw.gov.bd/" target="blank">আইন ও বিধ</a>

      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        সরকারি প্রতিষ্ঠান
      </a>
      <div class="dropdown-menu cus_dropdown_menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href=" {{url('/low_and_order')}} ">আইন-শৃঙ্খলা বিষয়ক</a>
        <a class="dropdown-item" href=" {{url('/health_issues')}} ">স্বাস্থ্য বিষয়ক</a>
        <a class="dropdown-item" href=" {{url('/agriculture_and_food')}} ">কৃষি ও খাদ্য বিষয়ক</a>
        <a class="dropdown-item" href=" {{url('/land_matters')}} ">ভূমি বিষয়ক</a>
        <a class="dropdown-item" href=" {{url('/gov_engineers')}} ">প্রকৌশল ও যোগাযোগ</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        অন্যান্য প্রতিষ্ঠান
      </a>
      <div class="dropdown-menu cus_dropdown_menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href=" {{url('/educational_institutions')}} ">শিক্ষা প্রতিষ্ঠান</a>
        <a class="dropdown-item" href=" {{url('/non_govern_organizations')}} ">বেসরকারি প্রতিষ্ঠান</a>
        <a class="dropdown-item" href=" {{url('/religious_institutions')}} ">ধর্মীয় প্রতিষ্ঠান</a>

      </div>
    </li>

    </ul> <!-- navbar ul end -->

    </div> <!-- navbar-collpase end -->
    </nav> <!-- navbar end -->
    </div> <!-- container end -->

    </section><!-- menu area end -->
    <!-- slider section start -->
    <!-- container start -->
    <div class="container page_shadow">
      <!--carousel wrapper -->
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner"> <!--carousel inner start -->
        <div class="carousel-item active"> <!-- 1st single carousel iteam start -->
        <img src="img/slider1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-sm-block">
          <div class="left_logo">
            <img src="img/slide_logo.png" class="img-fluid" alt="">
          </div>
          <div class="right_text">
            <h4>নাটোর সদর উপজেলা</h4>
            <h5>একটি স্বপ্ন একটি দেশ </br> ডিজিটাল বাংলাদেশ</h5>
          </div>
        </div>
        </div><!-- 1st single carousel iteam start -->

        <div class="carousel-item "> <!-- 2nd single carousel iteam start -->
        <img src="img/slide2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-sm-block">
          <div class="left_logo">
            <img src="img/slide_logo.png" class="img-fluid" alt="">
          </div>
          <div class="right_text">
            <h4>নাটোর সদর উপজেলা</h4>
            <h5>একটি স্বপ্ন একটি দেশ </br> ডিজিটাল বাংলাদেশ</h5>
          </div>
        </div>
        </div> <!-- 2nd single carousel iteam start -->

        </div><!--carousel inner end -->
        <!-- carousel control start -->
        <a class="carousel-control-prev cus_slider_control" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="fa fa-angle-double-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next cus_slider_control" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="fa fa-angle-double-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <!-- carousel control end -->
        </div><!--carousel wrapper end-->
        </div> <!-- container end -->

        <!-- slider section end -->
        <!-- all news marque section start -->
        <section id="all_news">
          <div class="container page_shadow">
            <div class="custom_news_wrap">
              <div class="left_news_con">
                <i class="fa fa-newspaper-o "></i>
                <h4 class="d-md-block d-none"> সকল খবর </h4>
                <i class="fa fa-angle-double-right" ></i>
              </div>
              <div class="right_news_con">
                <h5><marquee behavior="" direction="">নো মাস্ক নো সার্ভিস। করোনাভাইরাসের বিস্তার রোধে এখনই ডাউনলোড করুন Corona Tracer BD অ্যাপ। </marquee></h5>
              </div>
            </div>
          </div>
          </section> <!-- all news marque section end -->

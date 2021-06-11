@extends("index")
@section('title_area')
{{ (!empty($title)?$title:'') }}
@endsection
@section('all_union_content')
<!-- union section start -->
<section id="union_wrapper">
  <div class="container cus_union_con page_shadow">
    <h3 class="all_union">ইউনিয়ন সমূহ</h3>
    <div class="row">
        @if(!empty($unionList))
            @foreach($unionList as $union)
                <div class="col-md-4">
                    <div class="col_wrap">
                        <?php  $name = (!empty($union->union_name)?$union->union_name:''); $expUnion=explode('নং',$name);  ?>
                        <h3>{{ !empty($expUnion[0])?$expUnion[0].' নং ':'' }}</h3>
                        <h4>{{ !empty($expUnion[1])?$expUnion[1]:'' }} </h4>
                        <a href="{{  (!empty($union->web_url)?$union->web_url:'') }}" target="blank">ওয়েব সাইট লিংক <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
  </div>
</section>
<!-- union section end -->
@endsection
@section('main_content_area')
<!-- left side -->
<div class="col-md-8">
  <div class="left_content_wrap">
    <h2>করোনা ভাইরাস (কোভিড-১৯) সংক্রমণের বিদ্যমান পরিস্থিতিতে সরকারের সিদ্ধান্তসমূহ <a href="#">[ বিস্তারিত... ]</a> </h2>
    <img src="img/news.jpg" alt="" class="img-fluid">
    <div class="secont_section">
      <h4>সরকারি উদ্যেগ সমূহ</h4>
      <ul>
        <li><a href=""><i class="fa fa-hand-o-right" ></i> বাংলাদেশ সরকারের সপ্তম পঞ্চবার্ষিক পরিকল্পনা (২০১৬-২০২০) (১৩-০৬-২০১৬)</a></li>
        <li><a href=""><i class="fa fa-hand-o-right" ></i> বাংলাদেশ সরকারের ষষ্ঠ পঞ্চবার্ষিক পরিকল্পনা। (০৭-০৪-২০১৫)</a></li><li><a href=""><i class="fa fa-hand-o-right" ></i> দূর্যোগ ব্যবস্থাপনা জন্য জাতীয় পরিকল্পনা ২০১০-২০১৫। (০৭-০৪-২০১৫)</a></li>
        <li><a href=""><i class="fa fa-hand-o-right" ></i> বাংলাদেশ সরকারের ষষ্ঠ পঞ্চবার্ষিক পরিকল্পনা। (০৭-০৪-২০১৫)</a></li><li><a href=""><i class="fa fa-hand-o-right" ></i> বাংলাদেশ সরকারের প্রেক্ষিত পরিকল্পনা (২০১০-২০২১)। (০৭-০৪-২০১৫)</a></li>
      </ul>
      <a href="" class="full_details text-right">আরো দেখুন <i class="fa fa-angle-double-right" ></i></a>
      <div class="third_section">
        <h4>সহজে সেবা গ্রহন</h4>
        <div class="row"> <!--first row -->
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>আমাদের সম্পর্কে</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> উপজেলা নির্বাহী অফিসার</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> কর্মকর্তাগণ</a></li>
                  <li><a href="http://services.portal.gov.bd/"><i class="fa fa-caret-right"></i> সেবাসমূহ</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>ভূমি-সেবা</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box1.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href="http://xn--d5by7bap7cc3ici3m.xn--54b7fta0cc/"><i class="fa fa-caret-right"></i> উত্তরাধিকার ক্যালকুলেটর</a></li>
                  <li><a href="https://bangladesh.gov.bd/site/view/policy/"><i class="fa fa-caret-right"></i> আইন ও নীতিমালা</a></li>
                  <li><a href="https://land.gov.bd/asking/"><i class="fa fa-caret-right"></i> সচরাচর জিজ্ঞাসা</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        </div><!--first end -->
        <div class="row"> <!--second row -->
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>স্বাস্থ্য-সেবা</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box2.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> ডাক্তারের সাথে কথা বলুন</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> ডাক্তারেরতালিকা</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> হাসপাতাল ও ক্লিনিক</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>শিক্ষা-সেবা</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box3.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href="http://www.educationboardresults.gov.bd/"><i class="fa fa-caret-right"></i> পরীক্ষারফলাফল</a></li>
                  <li><a href="https://www.bangladesh.gov.bd/site/view/eservices/%E0%A6%AD%E0%A6%B0%E0%A7%8D%E0%A6%A4%E0%A6%BF%E0%A6%B0%20%E0%A6%86%E0%A6%AC%E0%A7%87%E0%A6%A6%E0%A6%A8/"><i class="fa fa-caret-right"></i> বিশ্ববিদ্যালয়সমূহ</a></li>
                  <li><a href="http://application.emis.gov.bd:4040/adminLogin.aspx/"><i class="fa fa-caret-right"></i> অনলাইনে MPO আবেদন</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        </div><!--second end -->
        <div class="row"> <!--third row -->
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>কৃষি</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box4.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> উন্নত জাতের বীজ</a></li>
                  <li><a href="http://www.ais.gov.bd/"><i class="fa fa-caret-right"></i> কৃষি তথ্য সেবা</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> উপসহকারী কৃষি কর্মকর্তা</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>নিরাপত্তা ও শৃংখলা</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box5.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href="http://ecourt.gov.bd/"><i class="fa fa-caret-right"></i> অপরাধের তথ্য দিন</a></li>
                  <li><a href="https://www.police.gov.bd/index.php"><i class="fa fa-caret-right"></i> পুলিশি সহায়তা</a></li>
                  <li><a href="https://play.google.com/store/apps/details?id=com.mcc.fire_service&hl=en/"><i class="fa fa-caret-right"></i> মোবাইলে ফায়ার সার্ভিস</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        </div><!--third end -->
        <div class="row"> <!--forth row -->
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>তথ্য অধিকার</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box6.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> তথ্য প্রদানকারী কর্মকর্তা</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> তথ্য আইন ও বিধিমালা</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> তথ্যের আবেদন ফরম</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>অভিযোগ প্রতিকার ব্যবস্থা</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box7.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> নির্দেশিকাসমূহ</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> অনলাইনে অভিযোগ দাখিল</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> অভিযোগ প্রতিকার ব্যবস্থা</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        </div><!--forth end -->
        <div class="row"> <!--fifth row -->
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>শুদ্ধাচার</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box8.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> জাতীয় শুদ্ধাচার কৌশল</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> উপজেলা কমিটি</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> কর্মপরিকল্পনা</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="common_box_wrap">
            <h5>জরূরি কল</h5>
            <div class="row">
              <div class="col-lg-4 ">
                <img src="img/box9.png" alt="" class="img-fluid">
              </div>
              <div class="col-lg-8 ">
                <ul>
                  <li><a href=""><i class="fa fa-caret-right"></i> ৩৩৩ থেকে তথ্য সেবা</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> কল সেন্টারসমূহ</a></li>
                  <li><a href=""><i class="fa fa-caret-right"></i> হেল্পডেস্ক</a></li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        </div><!--fifth end -->

      </div>
      <!-- fifth section start -->
      <section class="fifth_wrap">
        <h4>নোটিশ বোর্ড</h4>
        <ul>
          <li><a href=""><i class="fa fa-hand-o-right" ></i> করোনা ভাইরাস জনিত রোগ কোভিট-১৯ এর বিস্টার রোধকল্পে সার্বিক কার্যাবলি...</a></li>
          <li><a href=""><i class="fa fa-hand-o-right" ></i> ঠোর স্বাস্থ্যবিধি প্রতিপালন সাপেক্ষে দোকানপাঠ ও শপিংমল খোলা ...</a></li>
          <li><a href=""><i class="fa fa-hand-o-right" ></i> ঠোর স্বাস্থ্যবিধি প্রতিপালন সাপেক্ষে দোকানপাঠ ও শপিংমল খোলা ...</a></li>
        </ul>
      </section>


      <!-- fifth section end -->
      <!-- six section start -->
      <section class="fifth_wrap">
        <h4>আশ্রয়ণের অধিকার শেখ হাসিনার উপহার</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="img_box_wrap">
              <img src="img/video.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="col-md-6">
            <div class="img_box_wrap">
              <img src="img/video.jpg" alt="" class="img-fluid">
            </div>
          </div>
        </div>

      </section>
      <!-- six section end -->
    </div>
  </div>
  </div> <!-- left side end -->
  @endsection

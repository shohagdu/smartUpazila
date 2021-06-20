<aside id="left-panel">
    <?php
        $segment1 =  Request::segment(1);
        $segment2 =  Request::segment(2);
        $combine_segment=$segment1."/".$segment2;
        $isAdminEmployeeID=[
            1,2,2253,2267,2515,4277
        ];
        $employee_info=(!empty(session('user_info'))?session('user_info'):'');

    ?>
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a href="javascript:void(0);" id="show-shortcut" >
                <i class="glyphicon glyphicon-user fa-lg"></i>
                <span style="padding-left:5px;">
                     {{ Auth::user()->name }}
                </span>
            </a>
        </span>
    </div>
    <nav>
        <ul>
            <li  <?php if(in_array($segment1,['dashboard'])){ echo 'class="active"';} ?>>
                <a href="<?php  echo asset('/dashboard');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Home</span></a>
                <ul>
                    <li  <?php if(in_array($segment1,['people'])){ echo 'class="active"';} ?>>
                        <a href="{{url('people')}}" title="People"> <span class="menu-item-parent"> উপজেলা সম্পর্কে </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['notice'])){ echo 'class="active"';} ?>>
                        <a href="{{url('notice')}}" title="Notice"> <span class="menu-item-parent"> নোটিশ </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['/sangotonik-katamo'])){ echo 'class="active"';} ?>>
                        <a href="{{url('/sangotonik-katamo')}}" title="sangotonik-katamo"> <span class="menu-item-parent">   সাংগঠনিক কাঠামো  </span></a>
                    </li>   
                    <li  <?php if(in_array($segment1,['slider'])){ echo 'class="active"';} ?>>
                        <a href="{{url('slider')}}" title="All Type Title"><span class="menu-item-parent"> Slider </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['social-media'])){ echo 'class="active"';} ?>>
                        <a href="{{url('social-media')}}" title="All Type Title"><span class="menu-item-parent"> Social media </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['footer-area'])){ echo 'class="active"';} ?>>
                        <a href="{{url('footer-area')}}" title="Footer Area"><span class="menu-item-parent"> Footer Area </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['dynamic-content-page'])){ echo 'class="active"';} ?>>
                        <a href="{{url('dynamic-content-page')}}" title="dynamic content page"><span class="menu-item-parent"> Dynamic content page </span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" > উপজেলা সম্পর্কিত </span></a>
                <ul>
                    <li  <?php if(in_array($segment1,['upazilaIntroduction'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazilaIntroduction')}}" title="Upazila Introduction"> <span class="menu-item-parent">উপজেলা পরিচিতি</span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upazilaHistory'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazilaHistory')}}" title="Upazila History"> <span class="menu-item-parent">ইতিহাস ঐতিহ্য</span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upazilaGeographical'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazilaGeographical')}}" title="upazila Geographical"> <span class="menu-item-parent"> ভৌগলিক ও অর্থনৈতিক </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upPublicPeprestative'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upPublicPeprestative')}}" title="Upazila Public Peprestative"> <span class="menu-item-parent"> জনপ্রতিনিধিগণের তালিকা </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['freedom_fighter'])){ echo 'class="active"';} ?>>
                        <a href="{{url('freedom_fighter')}}" title="freedom fighter"> <span class="menu-item-parent"> মুক্তিযোদ্ধাদের তালিকা </span></a>
                    </li>
                    
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >উপজেলা পরিষদ</span></a>
                <ul>
                    <li  <?php if(in_array($segment1,['upazila_chairman'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazila_chairman')}}" title="upazila chairman"> <span class="menu-item-parent"> চেয়ারম্যান, উপজেলা পরিষদ  </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upazila_vice_chairman'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazila_vice_chairman')}}" title="upazila chairman"> <span class="menu-item-parent"> ভাইস চেয়ারম্যান </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upazila_female_vice_chairman'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazila_female_vice_chairman')}}" title="Female vice chairman"> <span class="menu-item-parent">মহিলা ভাইস চেয়ারম্যান </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['parisad-kajjoboli'])){ echo 'class="active"';} ?>>
                        <a href="{{url('parisad-kajjoboli')}}" title="Parisad kajjoboli"> <span class="menu-item-parent">উপজেলা পরিষদের কার্যাবলী </span></a>
                    </li>
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >পৌরসভা সম্পর্কিত</span></a>
                <ul>
                    
                    <li  <?php if(in_array($segment1,['pourosova-at-glance'])){ echo 'class="active"';} ?>>
                        <a href="{{url('pourosova-at-glance')}}" title="pourosova at glance"> <span class="menu-item-parent"> এক নজরে পৌরসভা </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['pourosova_mayor'])){ echo 'class="active"';} ?>>
                        <a href="{{url('pourosova_mayor')}}" title="pourosova mayor"> <span class="menu-item-parent"> মেয়র </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['pourosova_councilor'])){ echo 'class="active"';} ?>>
                        <a href="{{url('pourosova_councilor')}}" title="pourosova councilor"> <span class="menu-item-parent"> কাউন্সিলরগণ </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['pourosova_kormokorta'])){ echo 'class="active"';} ?>>
                        <a href="{{url('pourosova_kormokorta')}}" title="pourosova kormokorta"> <span class="menu-item-parent"> কর্মকর্তাবৃন্দ </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['pourosovaWard'])){ echo 'class="active"';} ?>>
                        <a href="{{url('pourosovaWard')}}" title="pourosova kormokorta"> <span class="menu-item-parent"> ওয়ার্ডসমূহ </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['pourosova_kormocari'])){ echo 'class="active"';} ?>>
                        <a href="{{url('pourosova_kormocari')}}" title="pourosova kormocari"> <span class="menu-item-parent"> কর্মচারীবৃন্দ  </span></a>
                    </li>   
                
                    <li  <?php if(in_array($segment1,['citizen-charter'])){ echo 'class="active"';} ?>>
                        <a href="{{url('citizen-charter')}}" title="citizen-charter"> <span class="menu-item-parent"> সিটিজেন চার্টার  </span></a>
                    </li>  
                    
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >সরকারি প্রতিষ্ঠান</span></a>
                <ul>
                     
                    <li  <?php if(in_array($segment1,['lowAndOrder'])){ echo 'class="active"';} ?>>
                        <a href="{{url('lowAndOrder')}}" title="low and order"> <span class="menu-item-parent"> আইন-শৃঙ্খলা বিষয়ক  </span></a>
                    </li>  
                    <li  <?php if(in_array($segment1,['health-issues'])){ echo 'class="active"';} ?>>
                        <a href="{{url('health-issues')}}" title="low and order"> <span class="menu-item-parent"> স্বাস্থ্য বিষয়ক </span></a>
                    </li>  
                    <li  <?php if(in_array($segment1,['agriculture-and-food'])){ echo 'class="active"';} ?>>
                        <a href="{{url('agriculture-and-food')}}" title="low and order"> <span class="menu-item-parent"> কৃষি ও খাদ্য বিষয়ক</span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['land-matters'])){ echo 'class="active"';} ?>>
                        <a href="{{url('land-matters')}}" title="low and order"> <span class="menu-item-parent">ভূমি বিষয়ক </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['govt-engineers'])){ echo 'class="active"';} ?>>
                        <a href="{{url('govt-engineers')}}" title="govt engineers"> <span class="menu-item-parent"> প্রকৌশল ও যোগাযোগ</span></a>
                    </li>
                   
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >অন্যান্য প্রতিষ্ঠান</span></a>
                <ul>                    
                    <li  <?php if(in_array($segment1,['educational-institutions'])){ echo 'class="active"';} ?>>
                        <a href="{{url('educational-institutions')}}" title="educational institutions"> <span class="menu-item-parent"> শিক্ষা প্রতিষ্ঠান </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['non_govt-organizations'])){ echo 'class="active"';} ?>>
                        <a href="{{url('non_govt-organizations')}}" title="non_govt organizations"> <span class="menu-item-parent"> বেসরকারি প্রতিষ্ঠান </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['religious-institutions'])){ echo 'class="active"';} ?>>
                        <a href="{{url('religious-institutions')}}" title="religious institutions"> <span class="menu-item-parent"> ধর্মীয় প্রতিষ্ঠান </span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Reports</span></a>
                <ul>
                    <li  <?php if(in_array($combine_segment,['unionSetup'])){ echo 'class="active"';} ?>>
                        <a href="{{url('unionSetup')}}" title="Union Setup"> <span class="menu-item-parent">ভিজিডি</span></a>
                    </li>

                    <li  <?php if(in_array($combine_segment,['upazilaSetup'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazilaSetup')}}" title="Upazila Setup"><span class="menu-item-parent">খাদ্য বান্ধব কর্মসূচি</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Setup</span></a>
                <ul>
                    <li  <?php if(in_array($segment1,['unionSetup'])){ echo 'class="active"';} ?>>
                        <a href="{{url('unionSetup')}}" title="Union Setup"> <span class="menu-item-parent">Union Setup</span></a>
                    </li>

                    <li  <?php if(in_array($segment1,['upazilaSetup'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazilaSetup')}}" title="Upazila Setup"><span class="menu-item-parent">Upazila Setup</span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['all-type-title'])){ echo 'class="active"';} ?>>
                        <a href="{{url('all-type-title')}}" title="All Type Title"><span class="menu-item-parent">All Type Title</span></a>
                    </li>
                    
                </ul>
            </li>


            <li  <?php if(in_array($segment1,['change_password'])){ echo 'class="active"';} ?>>
                <a href="<?php  echo asset('/change_password');?>" title="Change Password"><i class="fa fa-lg fa-fw fa fa-key"></i> <span class="menu-item-parent">Change Password</span></a>
            </li>
            <li >
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();" title="Sign Out"><i class="fa fa-lg fa-fw fa fa-sign-out"></i> <span class="menu-item-parent">Sign Out</span>  </a>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>


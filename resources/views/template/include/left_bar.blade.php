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
                <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Website Manage</span></a>
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
                    <li  <?php if(in_array($segment1,['upazila_chairman'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazila_chairman')}}" title="upazila chairman"> <span class="menu-item-parent"> চেয়ারম্যান, উপজেলা পরিষদ  </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upazila_vice_chairman'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazila_vice_chairman')}}" title="upazila chairman"> <span class="menu-item-parent"> ভাইস চেয়ারম্যান </span></a>
                    </li>
                    <li  <?php if(in_array($segment1,['upazila_female_vice_chairman'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazila_female_vice_chairman')}}" title="Female vice chairman"> <span class="menu-item-parent">মহিলা ভাইস চেয়ারম্যান </span></a>
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
                    <li  <?php if(in_array($combine_segment,['unionSetup'])){ echo 'class="active"';} ?>>
                        <a href="{{url('unionSetup')}}" title="Union Setup"> <span class="menu-item-parent">Union Setup</span></a>
                    </li>

                    <li  <?php if(in_array($combine_segment,['upazilaSetup'])){ echo 'class="active"';} ?>>
                        <a href="{{url('upazilaSetup')}}" title="Upazila Setup"><span class="menu-item-parent">Upazila Setup</span></a>
                    </li>
                    <li  <?php if(in_array($combine_segment,['all-type-title'])){ echo 'class="active"';} ?>>
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


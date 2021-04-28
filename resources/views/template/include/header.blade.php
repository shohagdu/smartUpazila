<header id="header" class="no-print" style="background: #28292b;">
    <div id="logo-group">
        <span id="logo">
            <!--
                @if( !empty(session('company_logo')) && file_exists('images/logo/'.session('company_logo')) )
                    <img  src=" {{ url('images\logo\header_logo.png')   }}" alt="Dhaka University"
                    >
                @else
                    <img  src="{{ url('images/default/default-avatar.png')   }}" alt="Dhaka University"
                          style="height: 29px;width:113px;">
                @endif
            -->
            <div style="font-size: 18px;font-weight:bold;color: #fff; ">Natore Sadar</div>
        </span>
        <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 0 </b> </span>
        <!-- END AJAX-DROPDOWN -->
    </div>
    <!-- pulled right: nav area -->
    <div class="pull-right">
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                        class="fa fa-reorder"></i></a> </span>
        </div>
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    <img src="{{ asset('fontView') }}/assets/img/avatars/sunny.png" alt="John Doe" class="online"/>
                </a>
        </ul>
    </div>
    <div id="logout" class="btn-header transparent pull-right">
        <span>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" title="Sign Out"><i class="fa fa-sign-out"></i>  </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </span>
    </div>

    <!-- end search mobile button -->

    <div id="fullscreen" class="btn-header transparent pull-right">
        <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i
                    class="fa fa-arrows-alt"></i></a> </span>
    </div>
<!--
{{--   <div  class="btn-header transparent pull-right">--}}
{{--        <span> <a href="<?php  echo asset('/human_resource');?>"  title="Office Automation"><i--}}
{{--                        class="fa fa-lg fa-fw fa-user"></i> Human Resource</a> </span>--}}
{{--    </div>--}}

{{--    <div class="btn-header transparent pull-right">--}}
{{--        <span> <a href="<?php  echo asset('/home');?>"  title="Full Screen"> <i--}}
{{--                        class="fa fa-lg fa-fw fa-home"></i> Dashboard</a> </span>--}}
{{--    </div>--}}
    -->
</header>

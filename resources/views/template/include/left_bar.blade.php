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


<!-- User info -->
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
            
                <li  <?php if(in_array($segment1,['all_employee_info'])){ echo 'class="active"';} ?>>
                    <a href="<?php  echo asset('/all_employee_info');?>" title="All Employee List"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">All Employee List</span></a>
                </li>



                <li>
					<a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Settings</span></a>
					<ul>

						<li  <?php if(in_array($segment1,['body'])){ echo 'class="active"';} ?>>
							<a href="{{url('body')}}" title="Dashboard"> <span class="menu-item-parent">Body</span></a>
						</li>

						<li <?php if(in_array($segment1,['category_setup'])){ echo 'class="active"';} ?> >
							<a href="<?php  echo asset('/category_setup');?>">Category</a>
						</li>
						<li <?php if(in_array($segment1,['category_details'])){ echo 'class="active"';} ?> >
							<a href="<?php  echo asset('/category_details');?>">Category Details</a>
						</li>


					</ul>
				</li>



				<li>
					<a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent" >Role</span></a>
					<ul>
						<li  <?php if(in_array($segment1,['feature'])){ echo 'class="active"';} ?>>
					<a href="{{url('feature')}}" title="Dashboard"> <span class="menu-item-parent">Feature</span></a>
				</li>

				<li  <?php if(in_array($segment1,['role_feature'])){ echo 'class="active"';} ?>>
					<a href="{{url('role_feature')}}" title="Dashboard"> <span class="menu-item-parent">Role Feature</span></a>
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


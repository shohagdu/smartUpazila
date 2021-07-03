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
        <li  <?php if(in_array($segment1,['home'])){ echo 'class="active"';} ?>>
                <a href="<?php  echo asset('/home');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
        </li>
        <?php
           
            $user_info =  App\Models\User::where(['id'=> Auth::user()->id])->first();
            $id = $user_info->role_id;

             $menuAccessArray = [];
             $get_role_info = App\Models\AclRoleInfo::where(['is_active'=> 1, 'id'=> $id])->first();
             $menuAccess = json_decode($get_role_info->role_info);
             foreach($menuAccess as $key=>$access){
                 if(gettype($access) == 'object') {
                     foreach($access as $asses) {
                         array_push($menuAccessArray, $asses);
                     }
                 }
                 if(gettype($access) == 'integer') {
                     array_push($menuAccessArray, $access);
                 }
                 array_push($menuAccessArray, $key);
             }    


            $get_menu_info = App\Models\AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>1])->get();
        
            if(!empty($get_menu_info)){
                foreach($get_menu_info as $key=> $mainMenu){
                   
                    $get_menu_info[$key]['mainChild']= App\Models\AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>2,'parent_id'=> $mainMenu->id])->get();
                }
            }
        ?>

        @foreach($get_menu_info as $item)
            <li>
                <a href="{{$item->link}}" 
                    @if(in_array($item->id , $menuAccessArray))
                     style="display:show"
                     @else
                     style="display:none"
                    @endif
                ><i class="{{$item->glyphicon_icon}}"></i> <span class="menu-item-parent" >{{$item->title}}</span></a>            
                    <ul>               
                    @if(!empty($item->mainChild))
                        @foreach($item->mainChild as $childKey => $row)                      
                            <li
                             @if(in_array($row->id , $menuAccessArray))
                               style="display:show"
                               @else
                               style="display:none"
                             @endif 
                    <?php if(in_array($segment1,[$row->link])){ echo 'class="active"';} ?>>
                                <a href="{{url($row->link)}}" title="{{$row->title}}"> <span class="menu-item-parent">{{$row->title}}</span></a>
                            </li>
                        @endforeach
                    </ul>  
                @endif
            </li>         
        @endforeach
           
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>


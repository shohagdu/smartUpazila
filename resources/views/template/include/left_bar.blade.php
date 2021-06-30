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
            $get_menu_info = App\Models\AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>1])->get();
        
            if(!empty($get_menu_info)){
                foreach($get_menu_info as $key=> $mainMenu){
                   
                    $get_menu_info[$key]['mainChild']= App\Models\AclMenuInfo::where(['is_active'=> 1,'is_main_menu'=>2,'parent_id'=> $mainMenu->id])->get();
                }
            }
        ?>

        @foreach($get_menu_info as $item)
            <li>
                <a href="{{$item->link}}"><i class="{{$item->glyphicon_icon}}"></i> <span class="menu-item-parent" >{{$item->title}}</span></a>            
                    <ul>               
                    @if(!empty($item->mainChild))
                        @foreach($item->mainChild as $childKey => $row)                      
                            <li  <?php if(in_array($segment1,[$row->link])){ echo 'class="active"';} ?>>
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


@extends("master")
@section('title_area')
    :: Home Page ::
@endsection
@section('main_content_area')
    <article>
        <div class="jarviswidget col-sm-12 col-md-12 col-lg-12" id="wid-id-2" data-widget-colorbutton="false"
             data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
                <h2>Dashboard</h2>

            </header>
            <div>
                <div class="widget-body no-padding">

                    <div class="col-sm-4">
                        <table class="table table-striped table-hover "
                               style="border:1px solid #d0d0d0;margin-top:10px">
                            <thead>
                            <tr>
                                <th colspan="2">Self Basic Information</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th style="width:130px;">Employee ID</th>
                                    <td>: {{ (isset(session('user_info')->employee_id) && !empty(session('user_info')->employee_id))?session('user_info')->employee_id:'' }}</td>
                            </tr>

                            @if (!empty(session('user_role')) && session('user_role')=='faculty')
                                <tr>
                                    <th style="width:130px;">Employee Name</th>
                                    <td>:
                                        {{ (isset(session('user_info')->name) && !empty(session('user_info')->name))?session('user_info')->name:'' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:130px;">Designation</th>
                                    <td>: {{ (isset(session('user_info')->designation_title) && !empty(session('user_info')->designation_title))?session('user_info')->designation_title:'' }}</td>
                                </tr>
                            @endif
                            @if (!empty(session('user_role')) && session('user_role')=='department')
                                <tr>
                                    <th style="width:130px;">Department</th>
                                    <td>: {{ (isset(session('user_info')->department_name) && !empty(session('user_info')->department_name))?session('user_info')->department_name:'' }}</td>
                                </tr>
                            @endif


                            <tr>
                                <th>Faculty</th>
                                <td>: {{ (isset(session('user_info')->faculty_name) && !empty(session('user_info')->faculty_name))?session('user_info')->faculty_name:'' }}</td>
                            </tr>

                            </tbody>

                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="table table-striped table-hover "
                               style="border:1px solid #d0d0d0;margin-top:10px">
                            <tbody>
                            <tr>
                                <th colspan="2" class="text-center">
                                    @if( !empty($company_info->company_logo) && file_exists('images/logo/'.$company_info->company_logo) )
                                        <img src=" {{ url('images/logo/'.$company_info->company_logo)   }}"
                                             alt="Woakfh Estate"
                                             style="height: 100px;">
                                    @else
                                        <img src=" {{ url('images/default/default-avatar.png')   }}" alt="Woakfh Estate"
                                             style="height: 100px;">
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th style="width:130px;">Company Name</th>
                                <td>: {{ $company_info->com_name }}</td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td>: {{ $company_info->address }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>: {{ $company_info->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $company_info->email }}</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>




                </div>

            </div>
        </div>




    </article>
    <article>





    </article>
    <div class="col-sm-12" style="height: 50px;"></div>

@endsection
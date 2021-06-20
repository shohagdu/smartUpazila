@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
    <div class="col-md-8">
        <div class="all_content_wrap">
            <h4>     {{ (!empty($heading)?$heading:'') }}</h4>
            @if(!empty($data))
                @foreach($data as  $key => $row)
                    <table class="table table-bordered table-striped table-style">
                        <thead>
                            <tr>
                                <th colspan="5" style="color: blue;font-size: 20px"> {{ (!empty($key)?$key:'') }}</th>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle" >ক্র: নং</th>
                                <th style="vertical-align: middle">সেবাসমুহ</th>
                                <th style="vertical-align: middle" >সেবা সরবরাহ/সেবা প্রাপ্তির প্রক্রিয়া</th>
                                <th style="vertical-align: middle">সেবার মুল্য</th>
                                <th style="vertical-align: middle">সেবা প্রাপ্তির সময়সীমা</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($row))
                                @php($i=1)
                                @foreach($row as $singleRow)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ (!empty($singleRow['services'])?$singleRow['services']:'') }}</td>
                                        <td>{{ (!empty($singleRow['services_process'])?$singleRow['services_process']:'') }}</td>
                                        <td>{{ (!empty($singleRow['services_price'])?$singleRow['services_price']:'') }}</td>
                                        <td>{{ (!empty($singleRow['services_time'])?$singleRow['services_time']:'') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <h3 class="text-center">কোন তথ্য পাওয়া যায় নি</h3>
                            @endif
                        </tbody>
                    </table>
                @endforeach
            @else
                <h3 class="text-center">কোন তথ্য পাওয়া যায় নি</h3>
            @endif
        </div>
    </div>
@endsection

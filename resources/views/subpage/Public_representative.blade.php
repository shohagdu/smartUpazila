@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<div class="col-md-8">
    <div class="all_content_wrap">
    <h4>নাটোর সদর উপজেলার বিভিন্ন জনপ্রতিনিধিগণের তালিকা</h4>
    <li>নাটোর সদর উপজেলার বিভিন্ন জনপ্রতিনিধিগণের তালিকাসর্বশেষ আপডেট: ১৭ জুলাই ২০১৮</li>
        <table class="table table-bordered table-style">
            <thead>
                <tr>
                    <th style="width: 12%" >ক্রমিক নং</th>
                    <th scope="col" > জনপ্রতিনিধিগণের  নাম ও পদবী</th>
                    <th style="width:20%"> মোবাইল নম্বর</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                    @php($i=1)
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ (!empty($row['name'])?$row['name']:'') }}
                                <div class="clearfix"></div>
                                {{ (!empty($row['designation'])?$row['designation']:'') }}

                            </td>
                            <td>{{ (!empty($row['mobile'])?$row['mobile']:'') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<div class="col-md-8">
    <div class="all_content_wrap">
        <h4>     {{ (!empty($heading)?$heading:'') }}</h4>
        @if(!empty($data))
            @foreach($data as $key=> $row)
                <table class="table table-bordered table-striped table-style">
                    <tbody>
                        <tr>
                            <td>নামঃ</td>
                            <td>{{ (!empty($row['name'])?$row['name']:'-') }}</td>
                        </tr>
                        <tr>
                            <td>পদবীঃ</td>
                            <td>{{ (!empty($row['designation'])?$row['designation']:'-') }}</td>
                        </tr>
                        <tr>
                            <td>ফোনঃ</td>
                            <td>{{ (!empty($row['mobile'])?$row['mobile']:'-') }}</td>
                        </tr>
                        <tr>
                            <td>ই-মেইল আইডিঃ</td>
                            <td>{{ (!empty($row['email'])?$row['email']:'-') }}</td>
                        </tr>
                        <tr>
                            <td>মূল দায়িত্ব সমূহঃ</td>
                            <td>{{ (!empty($row['responsibilities'])?$row['responsibilities']:'-') }}</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        @else
            <h3 class="text-center">কোন তথ্য পাওয়া যায় নি</h3>
        @endif
    </div>
</div>
@endsection

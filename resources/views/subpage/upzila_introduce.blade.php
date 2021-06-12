@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
    <div class="col-md-8">
        <div class="all_content_wrap">
            <h4 class="h4-title">এক নজরে উপজেলা</h4>
            <table class="table table-bordered table-style">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th scope="col">টাইটেল</th>
                        <th style="width:35%"> বর্ননা</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @if(!empty($data))
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ (!empty($row['title'])?$row['title']:'') }}</td>
                                <td>{{ (!empty($row['description'])?$row['description']:'') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

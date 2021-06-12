@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<div class="col-md-8">
  <div class="all_content_wrap">
    <h4>নাটোর সদর উপজেলার মুক্তিযোদ্ধাদের তালিকা</h4>
      <table class="table table-bordered table-style">
          <thead>
          <tr>
              <th style="width: 5%" > নং</th>
              <th style="width:25%" > নাম</th>
              <th style="width:25%"> পিতার নাম</th>
              <th style="width:30%"> ঠিকানা</th>
          </tr>
          </thead>
          <tbody>
          @if(!empty($data))
              @php($i=1)
              @foreach($data as $row)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td> {{ (!empty($row['name'])?$row['name']:'') }} </td>
                      <td> {{ (!empty($row['father_name'])?$row['father_name']:'') }} </td>
                      <td>{{ (!empty($row['village'])?$row['village']:'') }}</td>
                  </tr>
              @endforeach
          @else
              <tr>
                  <td colspan="4" class="text-center">No Data Found</td>
              </tr>
          @endif
          </tbody>
      </table>
  </div>
</div>

@endsection

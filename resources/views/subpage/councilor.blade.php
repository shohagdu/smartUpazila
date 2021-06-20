@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<!-- left side -->
<div class="col-md-8">
  <div class="all_content_wrap">
    <h4>কাউন্সিলর বৃন্দের প্রোফাইল </h4>
    <div class="row">
        @if(!empty($data))
            @foreach($data as $row)
                <div class="col-md-6">
                    <img src="<?php echo (!empty($row['image']) && (file_exists('img/councilor/'.$row['image']))?url('img/councilor/'.$row['image']):url('fontView/assets/img/avatars/male.png')) ?>" style="height: 200px;" onerror="{{ url('fontView/assets/img/avatars/male.png') }}" alt="" class="img-thumbnail img-width">
                    <h3 class="padding-bottom-50px">{{ (!empty($row['name'])?$row['name']:'-') }}</h3>
                    <p>ওয়ার্ড নংঃ    {{ (!empty($row['ward_no'])?$row['ward_no']:'-') }}</p>
                    <p>ইমেইলঃ    {{ (!empty($row['email'])?$row['email']:'-') }}</p>
                    <p>ফোনঃ    {{ (!empty($row['mobile'])?$row['mobile']:'-') }}</p>
                </div>
            @endforeach
        @endif
    </div>

  </div>
</div>
<!-- left end -->
@endsection

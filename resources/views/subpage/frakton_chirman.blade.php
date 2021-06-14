@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<div class="col-md-8">
    <div class="">
        <div class="">
            <table class="table table-bordered" style="width: 100%;margin-top: 10px">
                <thead>
                    <th>নং</th>
                    <th>ছবি</th>
                    <th>নাম</th>
                    <th>মেয়াদকাল</th>
                </thead>
                <tbody>
                    @if(!empty($data))
                        @php($i=1)
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <img src="<?php echo (!empty($row['image']) && (file_exists('img/upazila_chairman/'.$row['image']))?url('img/upazila_chairman/'.$row['image']):url('fontView/assets/img/avatars/male.png')) ?>" style="height: 60px;" onerror="{{ url('fontView/assets/img/avatars/male.png') }}" alt="" class="img-thumbnail"></td>

                                <td>{{ (!empty($row['name'])?$row['name']:'') }}</td>
                                <td>{{ (!empty($row['period_start'])?date('d M, Y',strtotime($row['period_start'])):'') }} to {{ (!empty($row['period_end'])?date('d M, Y',strtotime($row['period_end'])):'') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">কোন তথ্য পাওয়া যায় নি</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

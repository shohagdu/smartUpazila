@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<div class="col-md-8">
    <div class="col-sm-12" >
        <div class="col-md-4" style="float: left">
            <div class="col-sm-12" style="margin-top: 20px">
                <img src="<?php echo ((file_exists('img/upazila_chairman/'.$data['image']))?url('img/upazila_chairman/'.$data['image']):'') ?>" style="height: 200px;" alt="" class="img-thumbnail">
            </div>
        </div>
        <div class="col-md-8" style="float: right">
            <div class="uz_chirman_content">
                <h2>{{ (!empty($data['name'])?$data['name']:'') }}</h2>
                <h5 class="text-center">উপজেলা চেয়ারম্যান</h5>
                <h5><b>মোবাইল :</b> {{ (!empty($data['mobile'])?$data['mobile']:'') }}</h5>
                <h5><b>ইমেইল :</b> {{ (!empty($data['email'])?$data['email']:'') }}</h5>
                <h5><b>বর্তমান কর্মস্থলে যোগদানের তারিখ : :</b> {{ (!empty($data['period_start'])?date('d, M Y',strtotime($data['period_start'])):'') }}</h5>
                <div class="clearfix"></div>
                <?php echo (!empty($data['details'])?$data['details']:'') ?>
            </div>
        </div>
    </div>
</div>
@endsection

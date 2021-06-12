@extends("index")
@section('title_area')
    {{ (!empty($title)?$title:'') }}
@endsection
@section('main_content_area')
<div class="col-md-8">
    <div class="col-sm-12" style="background: red;">
        <div class="col-md-5 col-6">adsf</div>
        <div class="col-md-5 col-6">dd</div>
        <div class="col-sm-4" style="background: blue;">
            <img src="img/uz_chirman.jpg" alt="" class="img-fluid">
        </div>
        <div class="col-lg-4" style="background-color: blue;">
            <div class="uz_chirman_content">
                <h2>মোঃ শরিফুল ইসলাম রমজান</h2>
                <p>উপজেলা চেয়ারম্যান</p>
                <h5>ওয়ার্ড নং :০</h5>
                <hr>
                <h5>মোবাইল : 01711068382</h5>
                <h5>ফোন (অফিস) : 66377</h5>
                <h5>ইমেইল : romzanuzc@gmail.com</h5>
                <h5>নিজ জেলা: নাটোর</h5>
                <h5>স্থায়ী ঠিকানা : নাটোর</h5>
                <h5>সর্বশেষ শিক্ষাগত যোগ্যতা :</h5>
            </div>
        </div>
    </div>
</div>
@endsection

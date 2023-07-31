@extends("frontend/layouts/template/template") 

@section("content")
@php
    $logo = DB::table('image_logos')->where('status','เปิด')->value('image');
@endphp
<div class="container" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('about.about_us')</h2>
    <p>Andaman indigo phuket</p>
  </div>
</div>
<div class="container mb-5">
  <div class="row aos-init aos-animate" data-aos="fade-up">
      <div class="col-md-12">
        <h4  style="text-indent: 2.5em;">@lang('about.paragraph_1')</h4><br>
        <h4>@lang('about.paragraph_2')</h4><br>
        <img src="{{ asset('/image/indigo/map.jpg')}}" class="img-responsive" width="100%">
        <h4 class="mt-5">@lang('about.paragraph_3')</h4>
      </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6 col-12">
      <img src="{{ asset('/image/indigo/license.jpg')}}" class="img-responsive" width="100%">
    </div>
    <div class="col-md-6 col-12">
      <img src="{{ asset('/image/indigo/certificate.jpg')}}" class="img-responsive" width="100%">
    </div>
  </div>
</div>
@endsection
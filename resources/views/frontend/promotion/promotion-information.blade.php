@extends("frontend/layouts/template/template") 

@section("content")
<div class="container" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('promotion.promotion')</h2>
    @if(\Session::get('locale') == "th")
      <p>{{$promotion->title}}</p>
    @elseif(\Session::get('locale') == "en")
      <p>{{$promotion->title_eng}}</p>
    @else 
      <p>{{$promotion->title}}</p>
    @endif
  </div>
</div>

<div class="container mb-5" data-aos="fade-up">
  <div class="row">
    <div class="col-md-8">
      <img src="{{ asset('/image_upload/image_promotion_main')}}/{{$promotion->image_main}}" width="100%">
      <h4 class="mt-3">@lang('promotion.period') {{$promotion->date}} - {{$promotion->expire}}</h4>
      @php
        $image_multis = DB::table('promotion_image_multis')->where('promotion_id',$promotion->id)->get();
      @endphp
      <h4 class="mt-5">@lang('promotion.image')</h4><hr>
      <div class="row">
          @foreach ($image_multis as $image_multi => $value)
              <div class="col-md-4" style="margin-top: 20px;">
                  <img src="{{url('/image_upload/image_promotion_multi')}}/{{$value->image_multi}}" class="img-responsive" width="100%;">
              </div>      
          @endforeach
      </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
      @php
        $promotions = DB::table('promotions')->where('id','!=',$promotion->id)->paginate(5);
      @endphp
      <div style="background-color: #e4e4e4" class="mt-5">
          @foreach ($promotions as $promotion => $value)
              <a href="{{url('/promotion-information')}}/{{$value->id}}">
                  <img src="{{url('/image_upload/image_promotion_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;" style="padding:30px;">
              </a>
          @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
@extends("frontend/layouts/template/template") 

@section("content")
<div class="container" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('index.promotion')</h2>
    <p>@lang('index.promotion_2')</p>
  </div>
</div>

<div id="events" class="events">
    <div class="container" data-aos="fade-up">
      <div class="row">
        @foreach ($promotions as $promotion => $value)
          <?php
              $day = date_format(date_create_from_format('d/m/Y',$value->date),'d');
              $month = date_format(date_create_from_format('d/m/Y',$value->date),'m');
              $year = date_format(date_create_from_format('d/m/Y',$value->date),'Y');
              $year_ks = $year-543;

              $date_eng = $day."/".$month."/".$year_ks;
              $date_th = $year_ks."-".$month."-".$day;

              $date_format_eng = date_format(date_create_from_format('d/m/Y',$date_eng),'F d, Y');
              $date_format_th = thaidate('F j, Y', $date_th);
          ?>

          <?php
              $day_exp = date_format(date_create_from_format('d/m/Y',$value->expire),'d');
              $month_exp = date_format(date_create_from_format('d/m/Y',$value->expire),'m');
              $year_exp = date_format(date_create_from_format('d/m/Y',$value->expire),'Y');
              $year_ks_exp = $year_exp-543;

              $date_exp_eng = $day_exp."/".$month_exp."/".$year_ks_exp;
              $date_exp_th = $year_ks_exp."-".$month_exp."-".$day_exp;

              $date_exp_format_eng = date_format(date_create_from_format('d/m/Y',$date_exp_eng),'F d, Y');
              $date_exp_format_th = thaidate('F j, Y', $date_exp_th);
          ?>
          <div class="col-md-4 d-flex align-items-stretch">
            <a href="{{url('/promotion-information')}}/{{$value->id}}">
              <div class="card">
                <div class="card-img">
                  <img src="{{ asset('/image_upload/image_promotion_main')}}/{{$value->image_main}}">
                </div>
                <div class="card-body">
                  @if(\Session::get('locale') == "th")
                    <h5 class="card-title"><a href="">{{$value->title}}</a></h5>
                  @elseif(\Session::get('locale') == "en")
                    <h5 class="card-title"><a href="">{{$value->title_eng}}</a></h5>
                  @else 
                    <h5 class="card-title"><a href="">{{$value->title}}</a></h5>
                  @endif
                  @if(\Session::get('locale') == "th")
                    <p class="text-center">{{$date_format_th}} - {{$date_exp_format_th}}</p>
                  @elseif(\Session::get('locale') == "en")
                    <p class="text-center">{{$date_format_eng}} - {{$date_exp_format_eng}}</p>
                  @else 
                    <p class="text-center">{{$date_format_th}} - {{$date_exp_format_th}}</p>
                  @endif
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
</div>
@endsection
@extends("frontend/layouts/template/template") 

@section("content")
@php
    $type_th = DB::table('tour_types')->where('type_eng',$type)->value('type');
@endphp
<div class="container mt-5" data-aos="fade-up">
    <div class="section-title">
        <h2>@lang('index.tour_package')</h2>
        @if(\Session::get('locale') == "th")
            <p>{{$type_th}}</p>
        @elseif(\Session::get('locale') == "en")
            <p>{{$type}}</p>
        @else 
            <p>{{$type_th}}</p>
        @endif
    </div>
</div>
  
<div id="courses" class="courses mb-5">
    <div class="container" data-aos="fade-up">
      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        @foreach ($tours as $tour => $value)
        @php
            $type = DB::table('tour_types')->where('id',$value->type_id)->value('type');
            $type_eng = DB::table('tour_types')->where('id',$value->type_id)->value('type_eng');

            $price = DB::table('tour_prices')->where('tour_id',$value->id)->where('status','เปิด')->orderBy('id','desc')->value('price');
            $promotion_price = DB::table('tour_price_promotions')->where('tour_id',$value->id)->where('status','เปิด')->orderBy('id','desc')->value('price');
        @endphp
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <a href="{{url('/package-tour-information')}}/{{$value->id}}">
            <div class="course-item">
              <img src="{{ asset('/image_upload/image_tour_main')}}/{{$value->image_main}}" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  @if(\Session::get('locale') == "th")
                    <h4>{{$type}}</h4>
                    @if($price == null)
                      <p class="price">0.-</p>
                    @elseif($promotion_price == null)
                      <p class="price">0.-</p>
                    @else 
                      <p class="price"><Del style="color: red; font-size:14px;">{{$price}}.-</Del> {{$promotion_price}}.-</p>
                    @endif
                  @elseif(\Session::get('locale') == "en")
                    <h4>{{$type_eng}}</h4>
                    @if($price == null)
                      <p class="price">0.-</p>
                    @elseif($promotion_price == null)
                      <p class="price">0.-</p>
                    @else 
                      <p class="price"><Del style="color: red; font-size:14px;">{{$price}}.-</Del> {{$promotion_price}}.-</p>
                    @endif
                  @else 
                    <h4>{{$type}}</h4>
                    @if($price == null)
                      <p class="price">0.-</p>
                    @elseif($promotion_price == null)
                      <p class="price">0.-</p>
                    @else 
                      <p class="price"><Del style="color: red; font-size:14px;">{{$price}}.-</Del> {{$promotion_price}}.-</p>
                    @endif
                  @endif
                </div>
                
                @if(\Session::get('locale') == "th")
                  <h3><a href="{{url('/package-tour-information')}}/{{$value->id}}">{{$value->title}}</a></h3>
                @elseif(\Session::get('locale') == "en")
                  <h3><a href="{{url('/package-tour-information')}}/{{$value->id}}">{{$value->title_eng}}</a></h3>
                @else 
                  <h3><a href="{{url('/package-tour-information')}}/{{$value->id}}">{{$value->title}}</a></h3>
                @endif
    
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
    
                <div class="trainer" style="text-align: right;">
                  @if(\Session::get('locale') == "th")
                      <p>{{$date_format_th}} - {{$date_exp_format_th}}</p>
                  @elseif(\Session::get('locale') == "en")
                      <p>{{$date_format_eng}} - {{$date_exp_format_eng}}</p>
                  @else 
                      <p>{{$date_format_th}} - {{$date_exp_format_th}}</p>
                  @endif
                </div>
    
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
</div>
@endsection
@extends("frontend/layouts/template/template") 
<link href="{{ asset('frontend/carousel/css/style.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
@section("content")
@php
    $image = DB::table('image_slides')->where('status','เปิด')->value('image');
    $slides = DB::table('image_slides')->where('status','เปิด')->where('image','!=',$image)->get();
@endphp
<div class="container">
  <div class="section" id="carousel">
    <div class="card card-raised card-carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            @foreach ($slides as $slide => $value)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{$value->id}}" class=""></li>
            @endforeach
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{ asset('/image_upload/image_slide')}}/{{$image}}">
            </div>
            @foreach ($slides as $slide => $value)
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/image_upload/image_slide')}}/{{$value->image}}">
                </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <i class="material-icons">keyboard_arrow_left</i>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="material-icons">keyboard_arrow_right</i>
          </a>
        </div>
    </div>
  </div>
</div>

<div class="container mt-5" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('index.tour_package')</h2>
    <p>@lang('index.recommend')</p>
  </div>
</div>

<div id="courses" class="courses">
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

<div class="container mt-5" data-aos="fade-up">
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
                <img src="{{ asset('/image_upload/image_promotion_main')}}/{{$value->image_main}}" alt="...">
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

<div class="container" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('index.review')</h2>
    <p>@lang('index.thankyou')</p>
  </div>
</div>

<div id="events" class="events">
    <div class="container" data-aos="fade-up">
      <div class="row">
        @foreach ($reviews as $review => $value)
        <div class="col-md-3 d-flex align-items-stretch">
          <div class="card">
            <div class="card-img" id="single-images">
              <a href="{{ asset('/image_upload/image_review')}}/{{$value->image}}" class="singleImage2">
                <img src="{{ asset('/image_upload/image_review')}}/{{$value->image}}" alt="...">
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
</div>

<section id="popular-courses" class="courses">
  <div class="container" data-aos="fade-up">
      <div class="section-title">
          <h2>@lang('index.content')</h2>
          <p>@lang('index.article_2')</p>
      </div>
      <div class="row" data-aos="zoom-in" data-aos-delay="100">
          @foreach ($articles as $article => $value)
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
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <a href="{{url('/article-information')}}/{{$value->id}}">
              <div class="course-item">
                  <img src="{{ asset('/image_upload/image_article_main')}}/{{$value->image_main}}" class="img-fluid" alt="...">
                  <div class="course-content">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                          @if(\Session::get('locale') == "th")
                            <h4>{{$value->title}}</h4>
                          @elseif(\Session::get('locale') == "en")
                            <h4>{{$value->title_eng}}</h4>
                          @else 
                            <h4>{{$value->title}}</h4>
                          @endif
                      </div>
                      @if(\Session::get('locale') == "th")
                        <h5 class="ellipsis-verti">{!!$value->article!!}</h5>
                      @elseif(\Session::get('locale') == "en")
                        <h5 class="ellipsis-verti">{!!$value->article!!}</h5>
                      @else 
                        <h5 class="ellipsis-verti">{!!$value->article!!}</h5>
                      @endif
                      
                      <p style="text-align: right;">@lang('index.read_more')</p>
                      <hr>
                      @if(\Session::get('locale') == "th")
                        <p style="text-align: left;">{{$date_format_th}}</p>
                      @elseif(\Session::get('locale') == "en")
                        <p style="text-align: left;">{{$date_format_eng}}</p>
                      @else 
                        <p style="text-align: left;">{{$date_format_th}}</p>
                      @endif
                      
                  </div>
              </div>
            </a>
          </div>
          @endforeach
      </div>
  </div>
</section>

@endsection
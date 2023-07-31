@extends("frontend/layouts/template/template") 

@section("content")
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
                            <h5 class="ellipsis-verti">{!!$value->article!!}</h5>
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
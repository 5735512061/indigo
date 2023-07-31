@extends("frontend/layouts/template/template") 

@section("content")
@php
    $type_th = DB::table('tour_types')->where('id',$tour->type_id)->value('type');
    $type_eng = DB::table('tour_types')->where('id',$tour->type_id)->value('type_eng');
@endphp
<div id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8">
                <?php
                    $day = date_format(date_create_from_format('d/m/Y',$tour->date),'d');
                    $month = date_format(date_create_from_format('d/m/Y',$tour->date),'m');
                    $year = date_format(date_create_from_format('d/m/Y',$tour->date),'Y');
                    $year_ks = $year-543;

                    $date_eng = $day."/".$month."/".$year_ks;
                    $date_th = $year_ks."-".$month."-".$day;

                    $date_format_eng = date_format(date_create_from_format('d/m/Y',$date_eng),'F d, Y');
                    $date_format_th = thaidate('F j, Y', $date_th);
                ?>

                <?php
                    $day_exp = date_format(date_create_from_format('d/m/Y',$tour->expire),'d');
                    $month_exp = date_format(date_create_from_format('d/m/Y',$tour->expire),'m');
                    $year_exp = date_format(date_create_from_format('d/m/Y',$tour->expire),'Y');
                    $year_ks_exp = $year_exp-543;

                    $date_exp_eng = $day_exp."/".$month_exp."/".$year_ks_exp;
                    $date_exp_th = $year_ks_exp."-".$month_exp."-".$day_exp;

                    $date_exp_format_eng = date_format(date_create_from_format('d/m/Y',$date_exp_eng),'F d, Y');
                    $date_exp_format_th = thaidate('F j, Y', $date_exp_th);
                ?>

                <img src="{{ asset('/image_upload/image_tour_main')}}/{{$tour->image_main}}" class="img-fluid" alt="">
                @if(\Session::get('locale') == "th")
                    <h3>{{$type_th}} : {{$tour->title}}</h3>
                    <p style="text-align: right;">{{$date_format_th}} - {{$date_exp_format_th}}</p>
                @elseif(\Session::get('locale') == "en")
                    <h3>{{$type_eng}} : {{$tour->title_eng}}</h3>
                    <p style="text-align: right;">{{$date_format_eng}} - {{$date_exp_format_eng}}</p>
                @else 
                    <h3>{{$type_th}} : {{$tour->title}}</h3>
                    <p style="text-align: right;">{{$date_format_th}} - {{$date_exp_format_th}}</p>
                @endif
            </div>
            <div class="col-lg-4">
                @php
                    $tour_types = DB::table('tour_types')->where('status',"เปิด")->get();
                @endphp
                @foreach ($tour_types as $tour_type => $value)
                    <div class="course-info d-flex justify-content-between align-items-center">
                        @if(\Session::get('locale') == "th")
                            <h5>{{$value->type}}</h5>
                        @elseif(\Session::get('locale') == "en")
                            <h5>{{$value->type_eng}}</h5>
                        @else 
                            <h5>{{$value->type}}</h5>
                        @endif
                        <p><a href="{{url('/package-tour')}}/{{$value->type_eng}}">@lang('index.see_more') ...</a></p>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>
@php
    $image_multis = DB::table('tour_image_multis')->where('tour_id',$tour->id)->get();
@endphp
<div class="container mb-5" data-aos="fade-up">
    <h4 class="mt-5">@lang('article.image')</h4><hr>
    <div class="row">
      @foreach ($image_multis as $image_multi => $value)
        <div class="col-md-3" style="margin-top: 20px;">
            <img src="{{url('/image_upload/image_tour_multi')}}/{{$value->image_multi}}" class="img-responsive" width="100%;">
        </div>      
      @endforeach
    </div>
</div>
@endsection
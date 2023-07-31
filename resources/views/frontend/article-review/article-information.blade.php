@extends("frontend/layouts/template/template") 

@section("content")
<div class="container" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('index.content')</h2>
    <p>{{$article->title}}</p>
  </div>
</div>

<div class="single container mb-5" data-aos="fade-up">
  <div class="row">
    <div class="col-lg-8">
      <img src="{{ asset('/image_upload/image_article_main')}}/{{$article->image_main}}" width="100%">
      @php
        $image_multis = DB::table('article_image_multis')->where('article_id',$article->id)->get();
      @endphp
      <div class="single-content wow fadeInUp mt-5">
          @if(\Session::get('locale') == "th")
            <h2>{{$article->title}}</h2>
            <p>{!! $article->article !!}</p>
          @elseif(\Session::get('locale') == "en")
            <h2>{{$article->title_eng}}</h2>
            <p>{!! $article->article_eng !!}</p>
          @else 
            <h2>{{$article->title}}</h2>
            <p>{!! $article->article !!}</p>
          @endif
      </div>
      <h4 class="mt-5">@lang('article.image')</h4><hr>
      <div class="row">
        @foreach ($image_multis as $image_multi => $value)
          <div class="col-md-4" style="margin-top: 20px;">
              <img src="{{url('/image_upload/image_article_multi')}}/{{$value->image_multi}}" class="img-responsive" width="100%;">
          </div>      
        @endforeach
      </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
      @php
        $articles = DB::table('articles')->where('id','!=',$article->id)->paginate(5);
      @endphp
      <div style="background-color: #ffffff">
        <div class="sidebar">
            <div class="sidebar-widget wow fadeInUp">
                <h2 class="widget-title">@lang('article.article_other')</h2><hr>
                <div class="recent-post">
                  @foreach ($articles as $article => $value)
                    <div class="post-item mt-3">
                        <div class="post-img">
                            <img src="{{url('/image_upload/image_article_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;"/>
                        </div>
                        <div class="post-text">
                            @if(\Session::get('locale') == "th")
                              <a href="">{{$value->title}}</a>
                            @elseif(\Session::get('locale') == "en")
                              <a href="">{{$value->title_eng}}</a>
                            @else 
                              <a href="">{{$value->title}}</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
  </div> 
</div>   
@endsection
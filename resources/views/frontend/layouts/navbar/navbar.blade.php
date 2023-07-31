@php
  $logo = DB::table('image_logos')->where('status','เปิด')->value('image');
  $tour_types = DB::table('tour_types')->where('status','เปิด')->get();
@endphp
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <a href="{{url('/')}}" class="logo me-auto"><img src="{{url('/image_upload/image_logo')}}/{{$logo}}" class="img-fluid rounded-circle"></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="{{url('/')}}">@lang('index.home')</a></li>
          <li class="dropdown"><a href="#"><span>@lang('index.tour')</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              @foreach ($tour_types as $tour_type => $value)
                @if(\Session::get('locale') == "th")
                  <li><a href="{{url('/package-tour')}}/{{$value->type_eng}}">{{$value->type}}</a></li>
                @elseif(\Session::get('locale') == "en")
                  <li><a href="{{url('/package-tour')}}/{{$value->type_eng}}">{{$value->type_eng}}</a></li>
                @else 
                  <li><a href="{{url('/package-tour')}}/{{$value->type_eng}}">{{$value->type}}</a></li>
                @endif
              @endforeach
            </ul>
          </li>
          <li><a href="{{url('/article-review')}}">@lang('index.article')</a></li>
          <li><a href="{{url('/promotion')}}">@lang('index.promotion')</a></li>
          <li><a href="{{url('/about-us')}}">@lang('index.about_us')</a></li>
          <li><a href="{{url('/contact-us')}}">@lang('index.contact_us')</a></li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

        <div class="social-links get-started-btn">
          <a href="{{url('/locale/th')}}"><img src="https://img.icons8.com/color/30/000000/thailand.png"/></a>
          <a href="{{url('/locale/en')}}"><img src="https://img.icons8.com/color/30/000000/great-britain.png"/></a>
        </div>

    </div>
</header>

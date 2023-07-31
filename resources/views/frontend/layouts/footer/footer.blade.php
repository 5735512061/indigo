@php
  $logo = DB::table('image_logos')->where('status','เปิด')->value('image');
  $phone = DB::table('contacts')->value('phone');
  $facebook = DB::table('contacts')->value('facebook');
  $facebook_url = DB::table('contacts')->value('facebook_url');
  $line_url = DB::table('contacts')->value('line_url');
@endphp
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <center>
        <div class="footer-contact">
          <img src="{{url('/image_upload/image_logo')}}/{{$logo}}" class="img-responsive rounded-circle" width="15%">
          <p>@lang('contact.contact') : {{$phone}}</p>
          <p>Facebook :  {{$facebook}}</p> 
        </div>
        <div class="social-links">
          <a href="{{$facebook_url}}" target="_blank"><i class="fab fa-facebook-square"></i></a>
          <a href="{{$line_url}}"><i class="fab fa-line"></i></a>
          <a href="mailto: andamanindigo@gmail.com"><i class="fa fa-envelope"></i></a>
        </div>
        </center>
      </div>
    </div>
  </div>
</footer>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


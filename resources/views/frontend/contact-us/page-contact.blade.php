@extends("frontend/layouts/template/template") 
<style>
.hover-scale, .hover-scale:hover {
    transition: transform .2s ease-in;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .4rem;
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}
</style>
@section("content")
 
<div class="container" data-aos="fade-up">
  <div class="section-title">
    <h2>@lang('contact.social_media')</h2>
    <p>Andaman indigo phuket</p>
  </div>
</div>

<div class="container mb-5">
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 text-center justify-content-center px-xl-6 aos-init aos-animate" data-aos="fade-up">
        <div class="col my-3">
            <a href="{{$contact->facebook_url}}" target="_blank">
                <div class="card border-hover-primary hover-scale">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fab fa-facebook-square" style="font-size: 4rem; color: #1877f2;"></i>
                        </div>
                        <h6 class="font-weight-bold mb-3">{{$contact->facebook}}</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col my-3">
            <a href="{{$contact->line_url}}" target="_blank">
                <div class="card border-hover-primary hover-scale">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fab fa-line" style="font-size: 4rem; color: #06c152;"></i>
                        </div>
                        <h6 class="font-weight-bold mb-3">{{$contact->line}}</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col my-3">
            <a href="mailto: andamanindigo@gmail.com">
                <div class="card border-hover-primary hover-scale">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="far fa-envelope" style="font-size: 4rem; color: #ff0000;"></i>
                        </div>
                        <h6 class="font-weight-bold mb-3">{{$contact->mail}}</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
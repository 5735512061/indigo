@extends("/backend/layouts/template/template")

@section("content")
<div class="row">
<div class="col-md-2"></div>
<div class="col-xl-8 order-xl-1">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">เพิ่มข้อมูลบทความ</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-article')}}" enctype="multipart/form-data" method="post">@csrf
          <div class="pl-lg-4">
            <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                      <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
              @endforeach
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @if ($errors->has('title'))
                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title') }})</span>
                    @endif
                    <div class="form-group">
                        <label class="form-control-label">หัวข้อเรื่อง</label>
                        <input type="text" class="form-control" name="title" placeholder="กรุณากรอกหัวข้อเรื่องบทความ">
                    </div>
                </div>
                <div class="col-lg-6">
                  @if ($errors->has('title_eng'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title_eng') }})</span>
                  @endif
                  <div class="form-group">
                      <label class="form-control-label" for="input-username">หัวข้อเรื่อง (ภาษาอังกฤษ)</label>
                      <input type="text" id="input-username" class="form-control" name="title_eng" placeholder="กรุณากรอกหัวข้อเรื่องบทความ (ภาษาอังกฤษ)">
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                @if ($errors->has('date'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('date') }})</span>
                @endif
                <div class="form-group">
                    <label class="form-control-label" for="input-username">วัน/เดือน/ปี</label>
                    <input type="text" id="input-username" class="form-control" name="date" placeholder="กรุณากรอกวัน/เดือน/ปี">
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  @if ($errors->has('article'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('article') }})</span>
                  @endif
                    <div class="form-group">
                      <label class="form-control-label">เนื้อหาบทความ</label>
                      <textarea rows="5" class="form-control" placeholder="กรุณากรอกเนื้อหาบทความ" id="review-ckeditor1" name="article"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                @if ($errors->has('article_eng'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('article_eng') }})</span>
                @endif
                  <div class="form-group">
                    <label class="form-control-label">เนื้อหาบทความ (ภาษาอังกฤษ)</label>
                    <textarea rows="5" class="form-control" placeholder="กรุณากรอกเนื้อหาบทความ" id="review-ckeditor2" name="article_eng"></textarea>
                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                  @if ($errors->has('image_main'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image_main') }})</span>
                  @endif
                    <div class="form-group">
                        <label class="form-control-label">รูปภาพปกหลัก ขนาดรูปภาพ 378*300 pixel</label>
                        <input type="file" class="form-control form-control-alternative mitr" name="image_main">
                    </div>
                </div>
                <div class="col-lg-6">
                  @if ($errors->has('image_multi'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image_multi') }})</span>
                  @endif
                    <div class="form-group">
                        <label class="form-control-label">รูปภาพอื่นๆ (สามารถเลือกได้มากกว่า 1) ขนาดรูปภาพ 378*300 pixel</label>
                        <input type="file" class="form-control form-control-alternative mitr" name="image_multi[]" multiple="multiple">
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{asset('/vendor/japonline/laravel-ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('review-ckeditor1');
    CKEDITOR.replace('review-ckeditor2');
</script>
@endsection
@extends("/backend/layouts/template/template")

@section("content")
<div class="row">

<div class="col-md-2"></div>
<div class="col-xl-8 order-xl-1">
  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
  </div>
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">แก้ไขข้อมูลบทความ</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/edit-article')}}" enctype="multipart/form-data" method="post">@csrf
          <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    @if ($errors->has('article'))
                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('article') }})</span>
                    @endif  
                    <div class="form-group">
                      <label class="form-control-label">เนื้อหาบทความ</label>
                      <textarea rows="5" class="form-control" id="review-ckeditor1" name="article">{{$article->article}}</textarea>
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
                        <textarea rows="5" class="form-control" id="review-ckeditor2" name="article_eng">{{$article->article_eng}}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
                    <input type="hidden" name="id" value="{{$article->id}}">
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
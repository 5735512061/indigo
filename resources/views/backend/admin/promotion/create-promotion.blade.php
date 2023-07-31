@extends("/backend/layouts/template/template")

@section("content")
<div class="row">

<div class="col-md-2"></div>
<div class="col-xl-8 order-xl-1">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">เพิ่มข้อมูลโปรโมชั่น</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-promotion')}}" enctype="multipart/form-data" method="post">@csrf
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
                      <label class="form-control-label" for="input-username">หัวข้อโปรโมชั่น</label>
                      <input name="title" type="text" id="input-username" class="form-control" placeholder="กรุณากรอกหัวข้อโปรโมชั่น">
                  </div>
              </div>
              <div class="col-lg-6">
                @if ($errors->has('title_eng'))
                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title_eng') }})</span>
                @endif
                <div class="form-group">
                    <label class="form-control-label" for="input-username">หัวข้อโปรโมชั่น (ภาษาอังกฤษ)</label>
                    <input name="title_eng" type="text" id="input-username" class="form-control" placeholder="กรุณากรอกหัวข้อโปรโมชั่น (ภาษาอังกฤษ)">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                @if ($errors->has('date'))
                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('date') }})</span>
                @endif
                <div class="form-group">
                    <label class="form-control-label" for="input-username">วัน/เดือน/ปี เริ่มโปรโมชั่น</label>
                    <input name="date" type="text" id="input-username" class="form-control" placeholder="กรุณากรอกวัน/เดือน/ปี เริ่มโปรโมชั่น">
                </div>
              </div>
              <div class="col-lg-6">
                @if ($errors->has('expire'))
                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('expire') }})</span>
                @endif
                <div class="form-group">
                    <label class="form-control-label" for="input-username">วัน/เดือน/ปี สิ้นสุดโปรโมชั่น</label>
                    <input name="expire" type="text" id="input-username" class="form-control" placeholder="กรุณากรอกวัน/เดือน/ปี าิ้นสุดโปรโมชั่น">
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
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">สถานะ</label>
                    <select name="status" class="form-control">
                      <option value="เปิด">เปิด</option>
                      <option value="ปิด">ปิด</option>
                    </select>
                </div>
              </div>
              <div class="col-lg-6" style="margin-top: 30px;">
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
@endsection
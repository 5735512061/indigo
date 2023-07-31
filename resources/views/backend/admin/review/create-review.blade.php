@extends("/backend/layouts/template/template")

@section("content")
<div class="row">

<div class="col-md-2"></div>
<div class="col-xl-8 order-xl-1">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">เพิ่มรูปภาพรีวิว</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-review')}}" enctype="multipart/form-data" method="post">@csrf
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
                @if ($errors->has('image'))
                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image') }})</span>
                @endif
                  <div class="form-group">
                      <label class="form-control-label">รูปภาพปกหลัก ขนาดรูปภาพ 378*300 pixel</label>
                      <input type="file" class="form-control form-control-alternative mitr" name="image">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">สถานะ</label>
                    <select name="status" class="form-control">
                      <option value="เปิด">เปิด</option>
                      <option value="ปิด">ปิด</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="row">
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
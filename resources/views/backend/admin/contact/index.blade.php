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
            <h3 class="mb-0">แก้ไขข้อมูลติดต่อ</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-contact')}}" method="POST" enctype="multipart/form-data" autocomplete="off">@csrf
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('phone'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                  @endif
                  <div class="form-group">
                      <label class="form-control-label" for="input-username">เบอร์โทรศัพท์</label>
                      <input type="text" id="input-username" name="phone" class="form-control" value="{{$contact->phone}}">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('facebook'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('facebook') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">Facebook</label>
                    <input type="text" id="input-username" name="facebook" class="form-control" value="{{$contact->facebook}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ Facebook (ถ้ามี)</label>
                  <input type="text" id="input-username" name="facebook_url" class="form-control" value="{{$contact->facebook_url}}">
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                  @if ($errors->has('line'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('line') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">line</label>
                    <input type="text" id="input-username" name="line" class="form-control" value="{{$contact->line}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ line (ถ้ามี)</label>
                  <input type="text" id="input-username" name="line_url" class="form-control" value="{{$contact->line_url}}">
                </div>
              </div>
              <div class="col-md-3">
                  <input type="hidden" name="id" value="{{$contact->id}}">
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
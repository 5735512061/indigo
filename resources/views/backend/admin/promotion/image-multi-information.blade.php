@extends("/backend/layouts/template/template")

@section("content")
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
<h1>รูปภาพอื่นๆเพิ่มเติม</h1><br>
<a href="" class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-upload-image{{$promotion_id}}" data-id="{{$promotion_id}}">เพิ่มรูปภาพอื่นๆ</a>
<!-- Modal -->
<div class="modal fade" id="modal-upload-image{{$promotion_id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <div class="col-md-12">
                <form action="{{url('/admin/upload-promotion-image-multi')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="row">
                        <div class="col-lg-12">
                            @if ($errors->has('image_multi'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image_multi') }})</span>
                            @endif
                            <div class="form-group">
                                <label class="form-control-label">รูปภาพอื่นๆ (สามารถเลือกได้มากกว่า 1) ขนาดรูปภาพ 378*300 pixel</label>
                                <input type="file" class="form-control form-control-alternative mitr mt-3" name="image_multi[]" multiple="multiple">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
                            <input type="hidden" name="promotion_id" value="{{$promotion_id}}">
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
          </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    @foreach ($image_multis as $image_multi => $value)
    <div class="col-md-3">
        <div class="card">
            <img src="{{url('/image_upload/image_promotion_multi')}}/{{$value->image_multi}}" class="img-responsive" width="100%;"><br>
            <div class="row">
                <div class="col-md-8 col-8">
                    <a href="" type="button" data-toggle="modal" data-target="#modal-promotion-edit{{$value->id}}" data-id="{{$value->id}}" style="padding-right: 10px;">
                        แก้ไขรูปภาพ
                    </a>
                </div>
                <div class="col-md-4 col-4">
                    <a href="{{url('/admin/promotion-image-multi-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')" style="color: red;">
                        ลบรูปภาพ
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-promotion-edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขรูปภาพ</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('/admin/update-promotion-image-multi')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($errors->has('image_multi'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image_multi') }})</span>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label">รูปภาพ ขนาดรูปภาพ 378*300 pixel</label>
                                    <input type="file" class="form-control form-control-alternative mitr" name="image_multi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
                                <input type="hidden" name="id" value="{{$value->id}}">
                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

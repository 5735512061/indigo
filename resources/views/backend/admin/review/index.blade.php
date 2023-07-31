@extends("/backend/layouts/template/template")

@section("content")

<h1>รูปภาพรีวิว</h1><br>
<div class="row">
  <div class="col-xl-12">
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
              <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
      @endforeach
    </div>
    <div class="card">
      <div class="card-header border-0"  style="padding-left: 0;">
          <a href="{{url('/admin/create-review')}}" class="btn btn-primary">เพิ่มรูปภาพรีวิว</a>
      </div>
      <div class="table-responsive">
        {{$reviews->links()}}
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">รูปภาพรีวิว</th>
              <th scope="col">สถานะ</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reviews as $review => $value)
              <tr>
                <td>{{$NUM_PAGE*($page-1) + $review+1}}</td>
                <td><img src="{{url('/image_upload/image_review')}}/{{$value->image}}" class="img-responsive" width="5%;"></td>
                <td>{{$value->status}}</td>
                <td>
                  <a href="" type="button" data-toggle="modal" data-target="#modal-review-edit{{$value->id}}" data-id="{{$value->id}}">
                    <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                  </a>
                  <a href="{{url('/admin/review-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                    <i class="fa fa-trash" style="color:red; font-size:18px;"></i>
                  </a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="modal-review-edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขรูปภาพรีวิว</h5>
                        </div>
                        <form action="{{url('/admin/update-review')}}" enctype="multipart/form-data" method="post">@csrf
                          <div class="pl-lg-4">
                            <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      <label class="form-control-label">รูปภาพปกหลัก ขนาดรูปภาพ 378*300 pixel</label>
                                      <input type="file" class="form-control form-control-alternative mitr" name="image_main">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                      <option value="{{$value->status}}">{{$value->status}}</option>
                                      <option value="เปิด">เปิด</option>
                                      <option value="ปิด">ปิด</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-12">
                                  <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
                                  <input type="hidden" name="id" value="{{$value->id}}">
                                  <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                              </div>
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

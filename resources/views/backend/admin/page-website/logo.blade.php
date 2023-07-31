@extends("/backend/layouts/template/template")

@section("content")

<h1>จัดการรูปภาพโลโก้</h1><br>
<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header border-0"  style="padding-left: 0;">
          <a href="{{url('/admin/create-logo')}}" class="btn btn-primary">เพิ่มรูปภาพโลโก้</a>
      </div>
      <div class="table-responsive">
        {{$image_logos->links()}}
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">รูปภาพ</th>
              <th scope="col">สถานะ</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($image_logos as $image_logo => $value)
              <tr>
                <td>{{$NUM_PAGE*($page-1) + $image_logo+1}}</td>
                <td><img src="{{url('/image_upload/image_logo')}}/{{$value->image}}" class="img-responsive" width="100px;"></td>
                <td>{{$value->status}}</td>
                <td>
                  <a href="" type="button" data-toggle="modal" data-target="#modal-form{{$value->id}}" data-id="{{$value->id}}">
                    <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                  </a>
                  <a href="{{url('/admin/logo-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                    <i class="fa fa-trash" style="color:red; font-size:18px;"></i>
                  </a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="modal-form{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขรูปภาพโลโก้</h5>
                        </div>
                        <form action="{{url('/admin/update-logo')}}" enctype="multipart/form-data" method="post">@csrf
                            <input type="hidden" name="id" value="{{$value->id}}">
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>รูปภาพโลโก้</label>
                                        <input type="file" class="form-control form-control-alternative mitr" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label>สถานะ</label>
                                        <select class="form-control" name="status">
                                            <option value="{{$value->status}}">{{$value->status}}</option>
                                            <option value="เปิด">เปิด</option>
                                            <option value="ปิด">ปิด</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->id()}}">
                                <button type="submit" class="btn btn-primary">อัพเดตข้อมูล</button>
                                <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
                            </div>
                        </form>
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

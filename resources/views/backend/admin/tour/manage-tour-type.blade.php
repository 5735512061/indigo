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
            <h3 class="mb-0">เพิ่มประเภททัวร์</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-tour-type')}}" enctype="multipart/form-data" method="post">@csrf
          <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">ประเภททัวร์</label>
                        @if ($errors->has('type'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('type') }})</span>
                        @endif
                        <input type="text" class="form-control form-control-alternative mitr" name="type">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">ประเภททัวร์ (ภาษาอังกฤษ)</label>
                        @if ($errors->has('type_eng'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('type_eng') }})</span>
                        @endif
                        <input type="text" class="form-control form-control-alternative mitr" name="type_eng">
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
                <div class="col-md-3">
                    <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card">
        <div class="table-responsive">
          {{$tour_types->links()}}
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">ประเภททัวร์</th>
                <th scope="col">ประเภททัวร์ (ภาษาอังกฤษ)</th>
                <th scope="col">สถานะ</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tour_types as $tour_type => $value)
                <tr>
                  <td>{{$NUM_PAGE*($page-1) + $tour_type+1}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->type_eng}}</td>
                  <td>{{$value->status}}</td>
                  <td>
                    <a href="" type="button" data-toggle="modal" data-target="#modal-tour-type-edit{{$value->id}}" data-id="{{$value->id}}">
                      <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                    </a>
                    <a href="{{url('/admin/tour-type-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                      <i class="fa fa-trash" style="color:red; font-size:18px;"></i>
                    </a>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modal-tour-type-edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลประเภททัวร์</h5>
                                </div>
                                <form action="{{url('/admin/update-tour-type')}}" enctype="multipart/form-data" method="post">@csrf
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">ประเภททัวร์</label>
                                                    @if ($errors->has('type'))
                                                        <span class="text-danger" style="font-size: 17px;">({{ $errors->first('type') }})</span>
                                                    @endif
                                                    <input type="text" class="form-control form-control-alternative mitr" name="type" value="{{$value->type}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">ประเภททัวร์ (ภาษาอังกฤษ)</label>
                                                    @if ($errors->has('type_eng'))
                                                        <span class="text-danger" style="font-size: 17px;">({{ $errors->first('type_eng') }})</span>
                                                    @endif
                                                    <input type="text" class="form-control form-control-alternative mitr" name="type_eng" value="{{$value->type_eng}}">
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
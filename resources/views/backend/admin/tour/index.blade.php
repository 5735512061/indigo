@extends("/backend/layouts/template/template")

@section("content")

<h1>ข้อมูลแพ็กเกจทัวร์</h1><br>
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
          <a href="{{url('/admin/create-tour')}}" class="btn btn-primary">เพิ่มรายละเอียดทัวร์</a>
      </div>
      <div class="table-responsive">
        {{$tours->links()}}
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ประเภททัวร์</th>
                <th scope="col">หัวข้อแพ็กเกจทัวร์</th>
                <th scope="col">หัวข้อแพ็กเกจทัวร์ (ภาษาอังกฤษ)</th>
                <th scope="col">วันที่เริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">รูปภาพหลัก</th>
                <th scope="col">รูปภาพอื่นๆ</th>
                <th scope="col">สถานะ</th>
                <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tours as $tour => $value)
              @php
                  $type = DB::table('tour_types')->where('id',$value->type_id)->value('type');
              @endphp
              <tr>
                <td>{{$NUM_PAGE*($page-1) + $tour+1}}</td>
                <td>{{$type}}</td>
                <td>{{$value->title}}</td>
                <td>{{$value->title_eng}}</td>
                <td>{{$value->date}}</td>
                <td>{{$value->expire}}</td>
                <td><img src="{{url('/image_upload/image_tour_main')}}/{{$value->image_main}}" class="img-responsive" width="5%;"></td>
                <td>
                  <a href="{{url('/admin/tour-image-multi-information/')}}/{{$value->id}}">
                    <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                  </a>
                </td>
                <td>{{$value->status}}</td>
                <td>
                  <a href="" type="button" data-toggle="modal" data-target="#modal-tour-edit{{$value->id}}" data-id="{{$value->id}}">
                    <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                  </a>
                  <a href="{{url('/admin/tour-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                    <i class="fa fa-trash" style="color:red; font-size:18px;"></i>
                  </a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="modal-tour-edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลแพ็กเกจทัวร์</h5>
                        </div>
                        <form action="{{url('/admin/update-tour')}}" enctype="multipart/form-data" method="post">@csrf
                          <input type="hidden" name="id" value="{{$value->id}}">
                          <div class="pl-lg-12">
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
                                      <label class="form-control-label" for="input-username">หัวข้อแพ็กเกจทัวร์</label>
                                      <input name="title" type="text" id="input-username" class="form-control" value="{{$value->title}}">
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  @if ($errors->has('title_eng'))
                                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title_eng') }})</span>
                                  @endif
                                  <div class="form-group">
                                      <label class="form-control-label" for="input-username">หัวข้อแพ็กเกจทัวร์ (ภาษาอังกฤษ)</label>
                                      <input name="title_eng" type="text" id="input-username" class="form-control" value="{{$value->title_eng}}">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                @if ($errors->has('date'))
                                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('date') }})</span>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">วัน/เดือน/ปี ที่เริ่ม</label>
                                    <input name="date" type="text" id="input-username" class="form-control" value="{{$value->date}}">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                @if ($errors->has('expire'))
                                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('expire') }})</span>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">วัน/เดือน/ปี สิ้นสุด</label>
                                    <input name="expire" type="text" id="input-username" class="form-control" value="{{$value->expire}}">
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
                                <div class="form-group">
                                    <label class="form-control-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                      <option value="{{$value->status}}">{{$value->status}}</option>
                                      <option value="เปิด">เปิด</option>
                                      <option value="ปิด">ปิด</option>
                                    </select>
                                </div>
                              </div>
                            </div>
                            @php
                                $tour_types = DB::table('tour_types')->where('status','เปิด')->get();
                                $type = DB::table('tour_types')->where('id',$value->type_id)->value('type');
                            @endphp
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">ประเภททัวร์</label>
                                        <select name="type_id" class="form-control">
                                            <option value="{{$value->type_id}}">{{$type}}</option>
                                            @foreach ($tour_types as $tour_type => $value)
                                              <option value="{{$value->id}}">{{$value->type}}</option>
                                            @endforeach
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

@extends("/backend/layouts/template/template")

@section("content")

<h1>จัดการราคาแพ็กเกจทัวร์</h1><br>
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
                <th scope="col">ราคาปกติ</th>
                <th scope="col">ราคาโปรโมชั่น</th>
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
                @php
                    $tour_price = DB::table('tour_prices')->where('tour_id',$value->id)->orderBy('id','desc')->value('price');
                    $tour_price_promotion = DB::table('tour_price_promotions')->where('tour_id',$value->id)->orderBy('id','desc')->value('price');
                @endphp
                @if($tour_price == null)
                    <td style="color: red;">
                        0 
                        <a href="" type="button" data-toggle="modal" data-target="#modal-tour-price{{$value->id}}" data-id="{{$value->id}}">
                            <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                        </a>
                        <a href="{{url('/admin/tour-price-information/')}}/{{$value->id}}">
                          <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                        </a>
                    </td>
                @else 
                    <td>{{$tour_price}}.- 
                        <a href="" type="button" data-toggle="modal" data-target="#modal-tour-price{{$value->id}}" data-id="{{$value->id}}">
                            <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                        </a>
                        <a href="{{url('/admin/tour-price-information/')}}/{{$value->id}}">
                          <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                        </a>
                    </td>
                @endif
                @if($tour_price_promotion == null)
                    <td style="color: red;">0 
                        <a href="" type="button" data-toggle="modal" data-target="#modal-tour-price-promotion{{$value->id}}" data-id="{{$value->id}}">
                            <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                        </a>
                        <a href="{{url('/admin/tour-price-promotion-information/')}}/{{$value->id}}">
                          <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                        </a>
                    </td>
                @else 
                    <td style="color: red;">{{$tour_price_promotion}}.- 
                        <a href="" type="button" data-toggle="modal" data-target="#modal-tour-price-promotion{{$value->id}}" data-id="{{$value->id}}">
                            <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                        </a>
                        <a href="{{url('/admin/tour-price-promotion-information/')}}/{{$value->id}}">
                          <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                        </a>
                    </td>
                @endif
                <td>
                    
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="modal-tour-price{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">อัพเดตราคาแพ็กเกจทัวร์</h5>
                        </div>
                      <div class="modal-body">
                        <form action="{{url('/admin/update-tour-price')}}" enctype="multipart/form-data" method="post">@csrf
                          <input type="hidden" name="tour_id" value="{{$value->id}}">
                          <div class="pl-lg-12">
                            <div class="flash-message">
                              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                  @if(Session::has('alert-' . $msg))
                                      <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                  @endif
                              @endforeach
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                  @if ($errors->has('price'))
                                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('price') }})</span>
                                  @endif
                                  <div class="form-group">
                                      <label class="form-control-label" for="input-username">ราคาปกติ</label>
                                      <input name="price" type="text" id="input-username" class="form-control">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
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
                                <div class="col-lg-6">
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
              <!-- Modal -->
              <div class="modal fade" id="modal-tour-price-promotion{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">อัพเดตราคาโปรโมชั่นแพ็กเกจทัวร์</h5>
                        </div>
                      <div class="modal-body">
                        <form action="{{url('/admin/update-tour-price-promotion')}}" enctype="multipart/form-data" method="post">@csrf
                          <input type="hidden" name="tour_id" value="{{$value->id}}">
                          <div class="pl-lg-12">
                            <div class="flash-message">
                              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                  @if(Session::has('alert-' . $msg))
                                      <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                  @endif
                              @endforeach
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                  @if ($errors->has('price'))
                                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('price') }})</span>
                                  @endif
                                  <div class="form-group">
                                      <label class="form-control-label" for="input-username">ราคาโปรโมชั่น</label>
                                      <input name="price" type="text" id="input-username" class="form-control">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
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
                                <div class="col-lg-6">
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

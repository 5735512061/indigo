@extends("/backend/layouts/template/template")

@section("content")
<div class="container mt-5">
    <center><h1>แก้ไขข้อมูลส่วนตัว</h1></center>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{url('/admin/change-profile')}}" enctype="multipart/form-data" method="post">@csrf 
                        
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                @endif
                                <input type="text" class="form-control" name="name" value="{{ $profile->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('บทบาท') }}</label>
                            <div class="col-md-6">
                                <select name="role" class="form-control" style="font-family: 'Prompt';">
                                    <option value="{{ $profile->role }}">{{ $profile->role }}</option>
                                    <option value="ผู้ดูแล">ผู้ดูแล</option>
                                    <option value="ผู้แก้ไข">ผู้แก้ไข</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('สถานะ') }}</label>
                            <div class="col-md-6">
                                <select name="status" class="form-control" style="font-family: 'Prompt';">
                                    <option value="{{ $profile->status }}">{{ $profile->status }}</option>
                                    <option value="เปิด">เปิด</option>
                                    <option value="ปิด">ปิด</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อเข้าใช้งาน') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('username'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('username') }})</span>
                                @endif
                                <input type="text" class="form-control" name="username" value="{{ $profile->username }}">
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="id" value="{{$profile->id}}">
                            <button type="submit" class="btn btn-primary">อัพเดตข้อมูลส่วนตัว</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
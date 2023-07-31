@extends("/backend/layouts/template/template")

@section("content")
<div class="container mt-5">
    <center><h1>เปลี่ยนรหัสผ่าน</h1></center>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{url('/admin/change-password')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input id="oldpassword" type="password" class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" style="font-family:Prompt;" placeholder="รหัสผ่านเก่า" onfocus="this.placeholder = 'รหัสผ่านเก่า'" name="oldpassword" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input id="password" style="font-family:Prompt;" type="password" name="password" placeholder="รหัสผ่านใหม่" onfocus="this.placeholder = 'รหัสผ่านใหม่'" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input id="password-confirm" style="font-family:Prompt;" type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" onfocus="this.placeholder = 'ยืนยันรหัสผ่าน'" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" required autofocus>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
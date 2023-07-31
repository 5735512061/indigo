@extends("/backend/layouts/template/template-login")

@section("content")
<div class="container mt-5">
    <center><h1>เข้าสู่ระบบแอดมิน</h1></center>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{url('/admin/login')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-user-run"></i></span>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="ชื่อเข้าใช้งาน" value="{{ old('username') }}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">เข้าสู่ระบบแอดมิน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
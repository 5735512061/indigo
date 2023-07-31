<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('backend/assets/img/theme/user.png')}}">
                </span>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <a href="{{url('/admin/change-profile')}}/{{ Auth::guard('admin')->id() }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>แก้ไขข้อมูลส่วนตัว</span>
              </a>
              <a href="{{url('/admin/change-password')}}" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>เปลี่ยนรหัสผ่าน</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('admin.logout') }}" class="dropdown-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i><span>ออกจากระบบ</span></a>
                <form id="logout-form" action="{{ 'App\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
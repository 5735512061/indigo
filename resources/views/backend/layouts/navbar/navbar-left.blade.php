<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav" style="margin-top: 50px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ni ni-tv-2 text-primary"></i> จัดการข้อมูลแพ็กเกจทัวร์
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-left">
                            <a href="{{url('/admin/manage-tour-type')}}" class="dropdown-item">
                                <span>จัดการประเภททัวร์</span>
                            </a>
                            <a href="{{url('/admin/tour')}}" class="dropdown-item">
                                <span>รายละเอียดทัวร์</span>
                            </a>
                            <a href="{{url('/admin/tour-price')}}" class="dropdown-item">
                                <span>จัดการราคาแพ็กเกจทัวร์</span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/article')}}">
                            <i class="ni ni-chat-round text-primary"></i>
                            <span class="nav-link-text">จัดการข้อมูลบทความ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/review')}}">
                            <i class="ni ni-satisfied text-primary"></i>
                            <span class="nav-link-text">จัดการรูปภาพรีวิว</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/promotion')}}">
                            <i class="ni ni-money-coins text-primary"></i>
                            <span class="nav-link-text">จัดการข้อมูลโปรโมชั่น</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/image-slide')}}">
                            <i class="ni ni-album-2 text-primary"></i>
                            <span class="nav-link-text">จัดการรูปภาพสไลด์</span>
                        </a>    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/image-logo')}}">
                            <i class="ni ni-image text-primary"></i>
                            <span class="nav-link-text">จัดการรูปภาพโลโก้</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/contact')}}">
                            <i class="ni ni-settings text-primary"></i>
                            <span class="nav-link-text">แก้ไขข้อมูลการติดต่อ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/image-link')}}">
                            <i class="ni ni-image text-primary"></i>
                            <span class="nav-link-text">ฝากลิ้งค์รูปภาพ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
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
            <h3 class="mb-0">เพิ่มรูปภาพ</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-image-link')}}" enctype="multipart/form-data" method="post">@csrf
          <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">รูปภาพ</label>
                        @if ($errors->has('image'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image') }})</span>
                        @endif
                        <input type="file" class="form-control form-control-alternative mitr" name="image">
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
          {{$images->links()}}
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">รูปภาพ</th>
                <th scope="col">ลิ้งค์รูปภาพ</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($images as $image => $value)
                <tr>
                  <td>{{$NUM_PAGE*($page-1) + $image+1}}</td>
                  <td><img src="{{url('/image_upload/image_link')}}/{{$value->image}}" class="img-responsive" width="100px;"></td>
                  <td><a id="btn" data-url="http://localhost/indigo/public/image_upload/image_link/{{$value->image}}" href="#" class="btn btn-success" data-toggle="popover" data-placement="top" data-content="คัดลอกแล้ว">COPY LINK</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		var $temp = $("<input>");
		var $url = $('#btn').attr('data-url');
		$('#btn').click(function() {
			$("body").append($temp);
			$temp.val($url).select();
			document.execCommand("copy");
			$temp.remove();
		});
	});
</script>
@endsection
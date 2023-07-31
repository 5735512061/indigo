@extends("/backend/layouts/template/template")

@section("content")

<h1>ราคาแพ็กเกจทัวร์</h1><br>
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
        {{$tour_prices->links()}}
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>วันที่อัพเดตราคา</th>
                <th>ราคาล่าสุด</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tour_prices as $tour_price => $value)
              <tr>
                <td>{{$NUM_PAGE*($page-1) + $tour_price+1}}</td>
                <td>{{ date('Y-m-d', strtotime($value->created_at)) }}</td>
                @if($value->price == null)
                    <td style="color: red;">0</td>
                @else 
                    <td>{{$value->price}}.-</td>
                @endif
                <td>{{$value->status}}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@extends ('admin_layout')
@section ('admin_content')
<section class="wrapper">
  <div class="col-md-12 stats-info stats-last widget-shadow">
            <div class="stats-last-agile">
              <div class="panel-heading1">
                Quản lí người dùng
              </div>
              @if(session()->has('message'))
                <a href="javascript:window.location.reload();"><div class="alert alert-success">
                    {{ session()->get('message') }}
                </div></a>
              @elseif(session()->has('errmsg'))
                  <a href="javascript:window.location.reload();"><div class="alert alert-danger">
                      {{ session()->get('errmsg') }}
                  </div></a>
              @endif
              <table class="table stats-table ">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($customer as $key => $user)
                    <tr>
          						<td>{{$key+1}}</td>
          						<td>{{$user->customer_name}}</td>
          						<td>{{$user->customer_email}}</td>
          						<td>{{$user->customer_phone}}</td>
          						<td>
                        @foreach($address as $add)
                          @if($add->customer_id==$user->customer_id)
                            {{$add->shipping_address}}, {{$add->ward->nameWard}}, {{$add->province->nameProvince}}, {{$add->city->nameCity}}
                          @endif
                        @endforeach
          						</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
</section>
@endsection
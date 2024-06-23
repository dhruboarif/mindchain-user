@extends('user.layouts.master')


@section('user_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Redeem Coupons</div>
            </div>
            @if(Session::has('insert_success'))
<div class="alert alert-success d-flex align-items-center" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24">
       <use xlink:href="#check-circle-fill" />
   </svg>
   <div>
       {{Session::get('insert_success')}}
   </div>
</div>
@endif
            <div class="card-body">
                <div class="row">
                    @foreach($data as $value)
                    <div class="col-12 col-sm-2">
                        <div class="card">
                          <img class="card-img-top" src="{{asset('storage/'.$value->image)}}" alt="{{$value->title}}" style="height: 250px;">
                          <div class="card-body">
                            <!--<h5 class="card-title">{{$value->title}}</h5>-->
                            <p class="card-text">Value: {{$value->amount}}$</p>
                            <a href="{{route('user_cupon.redeem', $value->id)}}" class="btn btn-primary redeem_cupon">Redeem</a>
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
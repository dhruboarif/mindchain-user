@extends('admin.layouts.master')


@section('admin_content')
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Cupons</div>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('cupon-settings.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <lable>Image:</lable>
                            <input type="file" calss="form-control @error('file') is-invalid @enderror" name="file">
                            @error('file')
                            <div class="d-block invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Coupon Value</label>
                                <input type="test" class="form-control mt-1" name="amount" required>
                                @error('file')
                                <div class="d-block invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Cupon Lists</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <!--<th>Title</th>-->
                        <th>Image</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($data as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <!--<td>{{$value->title}}</td>-->
                            <td>
                                <img src="{{asset('storage/'.$value->image)}}" placeholder="{{$value->title}}" style="height: 50px; width: 50px;"/>
                            </td>
                            <td>{{$value->amount}}</td>
                            <td>
                                @if($value->status == '0')
                                <span class="badge badge-warning">inactive</span>
                                @else
                                <span class="badge badge-success">active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('cupon-settings.destroy', $value->id)}}" class="btn btn-danger delete_item">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete_item').click(function(e){
            e.preventDefault();
            
        })
    })
</script>
@endpush
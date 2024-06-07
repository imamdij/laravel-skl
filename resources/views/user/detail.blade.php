@extends('layouts.template')

@section('page-title')
Detail {{$user->name}}
@endsection


@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i>Sorry, Error</h5>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Area Detail Pemilik Toko --}}

<div class="row">
    <div class="col-md-12 col-sm-12">'

        {{-- Show Data Card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    About User ( Store Owner )
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>User Name</th>
                            <td width="5%"> : </td>
                            <td width="70%">{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td width="5%"> : </td>
                            <td width="70%">{{$user->email}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Card Edit --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Edit Data 
                </div>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('owner.update', $user->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>( Owner )  User Name</label>
                        <input type="text" name="name" value="{{$user->name}}" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="email" required class="form-control" value="{{$user->email}}">
                        <input type="text" name="level" hidden value="customer">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
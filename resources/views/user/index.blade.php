@extends('layouts.template')

@section('page-title')
User Data Page
@endsection

@section('content')

{{-- Ketika Ada Error --}}
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Store Owner Data</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-xl">
                            Create Data
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Store Owner's Name</th>
                            <th>Email</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            @if($item->level === 'customer')
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-secondary dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown"> Option </a>
                                    <div class="dropdown-menu" role="menu" style="margin-right: 20px">
                                        <a class="dropdown-item" href="{{route('owner.show', $item->id)}}">Detail</a>
                                        <form action="{{route('owner.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Delete Data?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Email</th>
                            <th>Pilihan</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Data User (Seller)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('owner.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name Seller</label>
                        <input type="text" name="name" required class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" required class="form-control">
                        <input type="text" name="level" hidden value="customer">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">+ Create New Data</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

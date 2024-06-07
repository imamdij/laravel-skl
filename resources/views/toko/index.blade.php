@extends('layouts.template')

@section('page-title')
Store Data Page
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
                        <h3 class="card-title">Store Data</h3>
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
                            <th>Store Name</th>
                            <th>Category</th>
                            <th>Store owner</th>
                            <th>Store Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toko as $item)
                        <tr>
                            <td>{{$item->nama_toko}}</td>
                            <td>{{$item->kategori_toko}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                @if($item->status_aktif == FALSE)
                                    <span class="badge badge-danger">Toko Non-Aktif</span>
                                @else
                                    <span class="badge badge-success">Toko Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-secondary dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown"> Option </a>
                                <div class="dropdown-menu" role="menu" style="margin-right: 20px">
                                    <a class="dropdown-item" href="{{route('store.show', $item->id)}}">Detail</a>

                                    <form action="{{route('store.destroy', $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Delete Data?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
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
                <h4 class="modal-title">Create Data Store</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Store Name</label>
                        <input type="text" name="nama_toko" required class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Owner Name</label>
                        <select name="id_user" class="form-control">
                            <option value="">Select The Owner's Name</option>
                            @foreach ($user as $item)
                                @if($item->level == 'customer')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Store Description</label>
                        <textarea name="desc_toko" id="summernote">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Store Image</label>
                        <input type="file" name="icon_toko" required class="form-control">
                    </div>
                    <input type="number" value="{{Auth::user()->id}}" hidden>
                    <div class="form-group">
                        <label>Store Category</label>
                        <select name="kategori_toko" class="form-control">
                            <option value="">Select a Category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Automotive">Automotive</option>
                            <option value="Groceries">Groceries</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Food">Food</option>
                            <option value="Medicine">Medicine</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Day Open : </label>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Monday" id="senin">
                                <label for="senin" class="custom-control-label">Monday</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Tuesday" id="selasa">
                                <label for="selasa" class="custom-control-label">Tuesday</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Wednesday" id="rabu">
                                <label for="rabu" class="custom-control-label">Wednesday</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Thursday" id="kamis">
                                <label for="kamis" class="custom-control-label">Thursday</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Friday" id="jumat">
                                <label for="jumat" class="custom-control-label">Friday</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Saturday" id="sabtu">
                                <label for="sabtu" class="custom-control-label">Saturday</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Sunday" id="minggu">
                                <label for="minggu" class="custom-control-label">Sunday</label>
                            </div>
                    </div>

                    <div class="row justify-content-arround">
                        <div class="form-group col-md-6">
                            <label for="">Opening Time</label>
                            <input type="time" class="form-control" name="jam_buka">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Closing Time</label>
                            <input type="time" class="form-control" name="jam_libur">
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="status_aktif" class="form-control" required>
                            <option value="0">Non Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
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

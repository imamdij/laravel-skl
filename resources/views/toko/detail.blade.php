@extends('layouts.template')

@section('page-title')
{{$data->nama_toko}} Details
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Sorry, Error</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Area Detai Pemilik Toko --}}
<div class="row">
    <div class="col-md-12 col-sm-12">
        {{-- show data card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>Store Details </h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>Store Name</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->nama_toko}}</td>
                            <td rowspan="7">
                                <img src="{{asset('storage/image/toko/'.$data->icon_toko)}}" style="width: 350px">
                            </td>
                        </tr>
                        <tr>
                            <th>Name of the Owner</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Store Status</th>
                            <td width="5%"> : </td>
                            <td width="50%">
                                @if ($data->status_aktif == TRUE)
                                    <span class="badge badge-success">Toko Aktif</span>
                                @else
                                    <span class="badge badge-danger">Toko Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->kategori_toko}}</td>
                        </tr>
                        <tr>
                            <th>Opening day</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->hari_buka}}</td>
                        </tr>
                        <tr>
                            <th>Operating Hours</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data->jam_buka}} - {{$data->jam_libur}}</td>
                        </tr>
                        <tr>
                            <th>Store Description</th>
                            <td width="5%"> : </td>
                            <td width="50%">{!! $data->desc_toko !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- card-edit --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('store.update', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Store Name</label>
                            <input type="text" name="nama_toko" class="form-control" value="{{$data->nama_toko}}">
                        </div>
                        {{-- <div class="form-group">
                            <label>Owner Name</label>
                            <select name="id_user" class="form-control">
                                <option value="">{{$data->user->name}}</option> 
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label>Store Description</label>
                            <textarea name="desc_toko" id="summernote">
                                {!! $data->desc_toko !!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Store Image</label>
                            <input type="file" name="icon_toko" class="form-control">
                        </div>
                        <input type="number" value="{{Auth::user()->id}}" hidden>
                        <div class="form-group">
                            <label>Store Category</label>
                            <select name="kategori_toko" class="form-control">
                                <option value="">Select a Category</option>
                                <option value="Electronics" {{$data->kategori_toko == 'Electronics' ? 'selected' : ''}}>Electronics</option>
                                <option value="Automotive" {{$data->kategori_toko == 'Automotive' ? 'selected' : ''}}>Automotive</option>
                                <option value="Groceries" {{$data->kategori_toko == 'Groceries' ? 'selected' : ''}}>Groceries</option>
                                <option value="Fashion" {{$data->kategori_toko == 'Fashion' ? 'selected' : ''}}>Fashion</option>
                                <option value="Food" {{$data->kategori_toko == 'Food' ? 'selected' : ''}}>Food</option>
                                <option value="Medicine" {{$data->kategori_toko == 'Medicine' ? 'selected' : ''}}>Medicine</option>
                                <option value="Accessories" {{$data->kategori_toko == 'Accessories' ? 'selected' : ''}}>Accessories</option>
                                <option value="Furniture" {{$data->kategori_toko == 'Furniture' ? 'selected' : ''}}>Furniture</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Day Open : </label>
                            @php
                            $hariBuka = $data->hari_buka ? explode(',', $data->hari_buka) : [];
                            @endphp
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Monday" id="senin" {{in_array('Monday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="senin" class="custom-control-label">Monday</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Tuesday" id="selasa" {{in_array('Tuesday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="selasa" class="custom-control-label">Tuesday</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Wednesday" id="rabu" {{in_array('Wednesday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="rabu" class="custom-control-label">Wednesday</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Thursday" id="kamis" {{in_array('Thursday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="kamis" class="custom-control-label">Thursday</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Friday" id="jumat" {{in_array('Friday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="jumat" class="custom-control-label">Friday</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Saturday" id="sabtu" {{in_array('Saturday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="sabtu" class="custom-control-label">Saturday</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="hari_buka[]" value="Sunday" id="minggu" {{in_array('Sunday', $hariBuka) ? 'checked' : ''}}>
                                    <label for="minggu" class="custom-control-label">Sunday</label>
                                </div>
                        </div>
    
                        <div class="row justify-content-arround">
                            <div class="form-group col-md-6">
                                <label for="">Opening Time</label>
                                <input type="time" class="form-control" name="jam_buka" value="{{$data->jam_buka}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Closing Time</label>
                                <input type="time" class="form-control" name="jam_libur" value="{{$data->jam_libur}}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <select name="status_aktif" class="form-control" required>
                                <option value="0" {{$data->status_aktif == '0' ? 'selected' : ''}}>Non Aktif</option>
                                <option value="1" {{$data->status_aktif == '1' ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>
    
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('store.index')}}">
                            <button type="button" class="btn btn-default">Back</button>     
                        </a>
                        <button type="submit" class="btn btn-secondary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
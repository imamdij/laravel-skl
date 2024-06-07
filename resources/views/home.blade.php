@extends('layouts.template')

@section('page-title')
 Dashboard
@endsection

@section('content')



@if(Auth::user()->level == 'admin')
{{-- Halaman Admin --}}
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>150</h3>

        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>

        <p>Bounce Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>44</h3>

        <p>User Registrations</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>

        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
@else
  {{-- Kondisi Jika Profile Belum Di Isi --}}
  @if(!$data_profile)
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fas fa-ban"></i>Halo, <b>{{Auth::user()->name}}</b></h4>
      <p>You have not completed your profile, please complete your profile.</p>
      <p>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-profile-xl">
          Create Data
        </button>
      </p>
    </div>

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

    {{-- Modal Profile --}}
    <div class="modal fade" id="modal-profile-xl">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Create Data User (Seller)</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{route('profile.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                          <label>Phone Number</label>
                          <input type="number" name="nomor_hp" required class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Date Of Birth</label>
                          <input type="date" name="tgl_lahir" required class="form-control">
                          <input type="text" name="id_user" hidden value="{{Auth::user()->id}}">
                      </div>
                      <div class="form-group">
                          <label>Gender</label>
                          <select type="" name="jenis_kelamin" class="form-control" required>
                            <option value="laki-laki">Male</option>
                            <option value="perempuan">Woman</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" name="foto-profile" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <textarea name="alamat" class="form-control" cols="10" rows="3" required></textarea>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-secondary">Save Changes</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  @else
    {{-- Jika user sudah melengkapi data, maka akan memunculkan berikut --}}

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5>Hallo , {{Auth::user()->name}}</h5>
          </div>
          <div class="card-body">
            <div class="row">
              {{-- Kolom yang pertama --}}
              <div class="col-md-4">
                <h6>Account Information</h6>
                <div class="table-responsive">
                  <table class="table table-borderless">
                    @foreach ($data_profile as $item)
                      <tr>
                        <th>Full name</th>
                        <td>{{$item->user->name}}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{$item->user->email}}</td>
                      </tr>
                      <tr>
                        <th>Level</th>
                        <td>{{$item->user->level}}</td>
                      </tr>
                    @endforeach
                  </table>
                </div>
              </div>
              {{-- Kolom yang kedua --}}
              <div class="col-md-4">
                <h6>Biodata Details</h6>
                <div class="table-responsive">
                  <table class="table table-borderless">
                    @foreach ($data_profile as $item)
                      <tr>
                        <th>Phone Number</th>
                        <td>{{$item->nomor_hp}}</td>
                      </tr>
                      <tr>
                        <th>Date of Birth</th>
                        <td>{{$item->tgl_lahir}}</td>
                      </tr>
                      <tr>
                        <th>Gender</th>
                        <td>{{$item->jenis_kelamin}}</td>
                      </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endif
@endif


@endsection

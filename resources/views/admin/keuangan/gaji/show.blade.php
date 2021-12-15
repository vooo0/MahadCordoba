@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('gaji.index')}}">Data Gaji</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$data->nama}}</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$data->nama}}</h6>
        <form class="forms-sample" action="{{route('dataGuru.update', $data->id,'edit')}}" method="post">
            @method('PATCH')
          @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Nama</label>
            <p class="form-control" id="exampleInputEmail1" >{{$data->nama}}</p>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            @if($data->email == NULL)
                <p class="form-control" id="exampleInputEmail1" >Belum Diisi</p>
            @else
                <p class="form-control" id="exampleInputEmail1" >{{$data->email}}</p>
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Telephone</label>
            @if($data->telephone == NULL)
                <p class="form-control" id="exampleInputEmail1" >Belum Diisi</p>
            @else
                <p class="form-control" id="exampleInputEmail1" >{{$data->telephone}}</p>
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat</label>
            @if($data->alamat == NULL)
                <p class="form-control" id="exampleInputEmail1" >Belum Diisi</p>
            @else
                <p class="form-control" id="exampleInputEmail1" >{{$data->alamat}}</p>
            @endif
          </div>
          <div class="form-group">
            <label>Gender</label>
            @if($data->jenisKelamin == NULL)
                <p class="form-control" id="exampleInputEmail1" >Belum Diisi</p>
            @else
                <p class="form-control" id="exampleInputEmail1" >{{$data->jenisKelamin}}</p>
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Foto</label>
            <input name="foto" type="file" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Upload Foto">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Gaji</h6>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buatGaji">
          Tambah Gaji
        </button>
        <!-- Modal -->
        <div class="modal fade" id="buatGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="forms-sample" action="{{route('gaji.gajiAdmin', $data->id,'edit')}}" method="post">
                  @csrf
                  <input name="admin_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$data->id}}">
                  <input name="gaji" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="0">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Keterangan</label>
                      <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Keterangan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tanggal</label>
                      <input name="tanggal" type="date" class="form-control" id="exampleInputUsername1" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Total Kehadiran / Mengajar</label>
                      <input name="kehadiran" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Total Kehadiran Pada Bulan Ini.">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Status</label>
                      <input name="status" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Status Gaji">
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Buat Gaji</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <table id="dataTableExample2" class="table">
            <thead>
              <tr>
                <th width="10">No.</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Kehadiran</th>
                <th>Status</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
            <?php $n1=1;$s=0; ?>
            @foreach($getGaji as $key => $gaji)
                <tr>
                    <td>{{$n1++}}</td>
                    <td>{{date_format($gaji->created_at, 'M-Y')}}</td>
                    <td>{{$gaji->nama}}</td>
                    <td>{{$gaji->kehadiran}} Kali</td>
                    <td>{{$gaji->status}}</td>
                    <td>
                      delete
                    </td>
                </tr>
                <?php $s++; ?>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
 


@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
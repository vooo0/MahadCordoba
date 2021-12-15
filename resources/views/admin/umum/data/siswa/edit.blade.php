@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('dataGuru.index')}}">Data Siswa</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$data->nama}}</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Siswa</h6>
        <form class="forms-sample" action="{{route('dataSiswa.update', $data->id,'edit')}}" method="post">
            @method('PATCH')
          @csrf
          <div class="form-group">
            <label for="exampleInputUsername1">Nama</label>
            <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" value="{{$data->nama}}" >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Email" value="{{$data->email}}" >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Telephone</label>
            <input  name="telephone" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Nomor Telephone" value="{{$data->telephone}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat</label>
            <input  name="alamat" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Alamat" value="{{$data->alamat}}">
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select name="jenisKelamin" class="form-control form-control-sm mb-3">
                @if($data->jenisKelamin)
                    <option selected>Pilih Gender</option>
                    <option value="{{$data->jenisKelamin}}" selected>Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                @elseif($data->jenisKelamin)
                    <option selected>Pilih Gender</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="{{$data->jenisKelamin}}"  selected>>Perempuan</option>
                @else
                    <option selected>Pilih Gender</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                @endif
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Foto</label>
            <input name="foto" type="file" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Upload Foto">
          </div>
          <button type="submit" class="btn btn-primary btn-icon-text"><i class="btn-icon-prepend" data-feather="check-square"></i>Update</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tambah Kelas</h6>
        <form class="forms-sample" action="{{route('kelasSiswa.store')}}" method="post">
            @csrf
            <input type="hidden" name="siswa_id" value="{{$data->id}}">
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Kelas Tersedia</label>
            <select name="kelas_id" >
                <option value="">Pilih Kelas</option>
                @foreach($getKelasGuru as $key => $gkg)
                <option value="{{$gkg->id}}">{{$gkg->matapelajaran->nama}} [{{$gkg->guru->nama}}]</option>
                @endforeach
            </select>
          </div>
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tahun</label>
            <select name="tahun_id" >
                <option value="">Pilih Tahun</option>
                @foreach($th as $key => $tahun)
                    <option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
            <input name="status" type="text" class="form-control" id="exampleInputMobile" placeholder="Status">
          </div>
          <button type="submit" class="btn btn-primary btn-icon-text"><i class="btn-icon-prepend" data-feather="check-circle"></i>Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>
 
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Kelas Diambil</h6>
        <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th width="10">No.</th>
                <th>Matapelajaran</th>
                <th>Guru</th>
                <th>Tahun Ajaran</th>
                <th>Status</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
            <?php $n1=1;$s=0; ?>
            @foreach($mpSiswa as $key => $mps)
                <tr>
                    <td>{{$n1++}}</td>
                    <td>{{$mps->matapelajaran->nama}}</td>
                    <td>{{$mps->guru->nama}}</td>
                    <td>{{$mps->tahun->tahun}}</td>
                    <td>{{$mps->status}}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="file"></i>Edit</a>
                        <a href="" class="btn btn-danger btn-icon-text"><i class="btn-icon-prepend" data-feather="trash"></i>Delete</a>
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
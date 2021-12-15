@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data pendaftar</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data pendaftar</h6>
        <p class="card-description">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah
          </button>
          <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#modalPdf">
            <i class="btn-icon-prepend" data-feather="printer"></i>PDF
          </button>
        </p>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pendaftaran Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('pendaftaran.store')}}" method="post">
                  @csrf
                  <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="1">
                  <div class="form-group">
                    <label for="exampleInputUsername1">Nama</label>
                    <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Email" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telephone</label>
                    <input  name="telephone" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Nomor Telephone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                    <input  name="tanggalLahir" type="date" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat Asli</label>
                    <input  name="alamatAsli" type="textArea" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Alamat Asli">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat Sekarang</label>
                    <input  name="alamatSekarang" type="textArea" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Alamat Sekarang">
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select name="jenisKelamin" class="form-control form-control-sm mb-3">
                      <option selected>Pilih Gender</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Pendidikan Terakhir</label>
                    <select name="pendidikan" class="form-control form-control-sm mb-3">
                      <option selected>Pilih Pendidikan Terkahir</option>
                      <option value="tidak sekolah">Tidak Sekolah</option>
                      <option value="SD">Sekolah Dasar (SD)</option>
                      <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                      <option value="SMA">Sekolah Menengah Akhir / Sekolah Menengah Kejurusan (SMA/SMK)</option>
                      <option value="S1">Unicersitas Lulusan Sarjana (SI)</option>
                      <option value="S2">Unicersitas Lulusan Magister (S2)</option>
                      <option value="S3">Unicersitas Lulusan Doktor (S3)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Stauts KTP</label>
                    <select name="statusKtp" class="form-control form-control-sm mb-3">
                      <option selected>Pilih Status</option>
                      <option value="lajang">Lajang / Belum Menikah</option>
                      <option value="menikah">Menikah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Foto KTP</label>
                    <input name="fotoKtp" type="file" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Upload Foto">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alasan</label>
                    <input name="alasan" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Alasan Anda Belajar Bahasa Arab">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">MOTO</label>
                    <input name="moto" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="MOTO Hidup Anda">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pendaftaran Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('admin.pdf')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <h6 class="card-title">Dari Tanggal</h6>
                      <input name="dateStart" type="date" class="form-control">
                  </div>
                  <div class="card-body">
                    <h6 class="card-title">Sampai Tanggal</h6>
                      <input name="dateEnd" type="date" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Print</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <br>
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>alamat Sekarang</th>
                <th width="30" style="text-align: center">Status</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['pendaftaran'] as $key => $pendaftar)
                <tr>
                  <td>{{$pendaftar->nama}}</td>
                    @if(!empty($pendaftar->email))
                    
                    @endif
                  <td>
                    @if(!empty($pendaftar->email))
                      {{$pendaftar->email}}
                      @else
                      Belum Diisi
                      @endif
                  </td>
                  <td>
                    @if(!empty($pendaftar->telephone))
                    {{$pendaftar->telephone}}
                    @else
                      Belum Diisi
                    @endif
                  </td>
                  <td>
                    @if(!empty($pendaftar->alamatSekarang))
                    {{$pendaftar->alamatSekarang}}
                    @else
                      Belum Diisi
                    @endif
                  </td>
                  <td style="text-align:center;">
                    @if($pendaftar->status == '1')
                      <p class="btn btn-warning">Belum Dikonfirmasi</p>
                    @elseif($pendaftar->status == '2')
                      <p class="btn btn-success">Diterima</p>
                    @else
                      <p class="btn btn-danger">Ditolak</p>
                    @endif
                  </td>
                  <td>
                    <form action="{{route('pendaftaran.destroy', $pendaftar->id)}}" method="post">
                      <a href="{{route('pendaftaran.edit', $pendaftar->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="file"></i>Edit</a>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-icon-text" ><i class="btn-icon-prepend" data-feather="trash"></i>Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
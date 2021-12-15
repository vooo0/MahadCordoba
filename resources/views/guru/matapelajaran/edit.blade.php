@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/guru">Admin</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="">Data Pelajaran</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Informasi Siswa</h6>
        <form class="forms-sample">
          <div class="form-group">
            <label for="exampleInputUsername1">Foto</label>
            <img src="" alt="">
          </div>
          <div class="form-group">
            <label for="exampleInputUsername1">Nama</label>
            <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" disabled value="{{$getSiswa->nama}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" disabled value="{{$getSiswa->email}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Telehphone</label>
            <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" disabled value="{{$getSiswa->telephone}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat Asli</label>
            <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" disabled value="{{$getSiswa->alamatAsli}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat Sekarang</label>
            <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" disabled value="{{$getSiswa->alamatSekarang}}">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Daftar Nilai </h6>
        <div class="table-responsive">
          <table id="dataTableExample2" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Matapelajaaran</th>
                <th>Nilai</th>
                <th style="text-align: center;">Status</th>
                <th width="30" style="text-align: center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($getNilai as $key => $value)
                <tr>
                  <td>{{date_format($value->created_at, 'd-M-Y')}}</td>
                  <td>{{$value->nama}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>{{$value->nilai}}</td>
                  <td style="text-align: center;">
                    @if($value->nilai <= 50)
                      F
                    @elseif($value->nilai >= 51 && $value->nilai <= 60)
                      E
                    @elseif($value->nilai >= 61 && $value->nilai <= 70)
                      D
                    @elseif($value->nilai >= 71 && $value->nilai <= 80)
                      C
                    @elseif($value->nilai >= 81 && $value->nilai <= 90)
                      B
                    @elseif($value->nilai >= 91 && $value->nilai <= 100)
                      A
                    @else
                      Tidak ada Nilai
                    @endif
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$value->id}}">
                      <i class="btn-icon-prepend" data-feather="edit"></i>Ubah
                    </button>
                    <div class="modal fade" id="edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="updateNilai" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="updateNilai">Edit Tugas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="forms-sample" action="{{route('nilai.update', $value->id)}}" method="post">
                              @csrf
                              @method('PATCH')
                              <input name="siswa_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->siswa_id}}">
                              <input name="guru_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->guru_id}}">
                              <input name="matapelajaran_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->matapelajaran_id}}">
                              <input name="kelas_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->id}}">
                              <input name="tugas_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$value->id}}">
                              <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                              <input name="tanggal" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Nama Siswa</label>
                                  <input disabled type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->siswa->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Guru</label>
                                  <input disabled type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{Auth::user()->guru->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Matapelajaran / Kelas</label>
                                  <input disabled type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->matapelajaran->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Nama Tugas</label>
                                  <input disabled name="nama" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" value="{{$value->nama}}">
                                  <input name="nama" type="hidden" class="form-control" id="exampleInputPassword1" autocomplete="off" value="{{$value->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Nilai</label>
                                  <input name="nilai" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" value="{{$value->nilai}}"
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Daftar Tugas</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th width="30" style="text-align: center;">Tanggal</th>
                <th>Matapelajaran</th>
                <th>Tugas</th>
                <th width="30" style="text-align: center;">Status</th>
                <th width="30" style="text-align: center;">File</th>
                <th width="30" style="text-align: center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($getTugas as $key => $value)
                <tr>
                  <td>{{date_format($value->created_at, 'd-M-Y')}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>{{$value->nama}}</td>
                  <td style="text-align: center;">
                    @if($value->status == '0')
                    <button class="btn btn-warning" disabled>Belum Dinilai</button>
                    @elseif($value->status == '1')
                    <button class="btn btn-success" disabled>Sudah Dinilai</button>
                    @else
                    <button class="btn btn-danger" disabled>Tidak Ada</button>
                    @endif
                  </td>
                  <td><a href="{{$value->pdf}}" class="btn btn-primary">Download File</a></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$value->id}}">
                      <i class="btn-icon-prepend" data-feather="award"></i>Beri Nilai
                    </button>
                    <div class="modal fade" id="edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="editTugas" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editTugas">Edit Tugas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="forms-sample" action="{{route('nilai.store')}}" method="post">
                              @csrf
                              <input name="siswa_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->siswa_id}}">
                              <input name="guru_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->guru_id}}">
                              <input name="matapelajaran_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->matapelajaran_id}}">
                              <input name="kelas_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->id}}">
                              <input name="tugas_id" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$value->id}}">
                              <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                              <input name="tanggal" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Nama Siswa</label>
                                  <input disabled type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->siswa->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Guru</label>
                                  <input disabled type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{Auth::user()->guru->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Matapelajaran / Kelas</label>
                                  <input disabled type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$getKelas->matapelajaran->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Nama Tugas</label>
                                  <input disabled name="nama" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" value="{{$value->nama}}">
                                  <input name="nama" type="hidden" class="form-control" id="exampleInputPassword1" autocomplete="off" value="{{$value->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Nilai</label>
                                  <input name="nilai" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
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
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
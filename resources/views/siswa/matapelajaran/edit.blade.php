@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/siswa">siswa</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="">Data Pelajaran</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Informasi Guru</h6>
        <form class="forms-sample">
          <div class="form-group">
            <label for="exampleInputUsername1">Foto</label>
            <img src="" alt="">
          </div>
          <div class="form-group">
            <label for="exampleInputUsername1">Nama</label>
            <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" disabled value="{{$data['getKelasSiswa']->guru->nama}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" disabled value="{{$data['getKelasSiswa']->guru->email}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Telehphone</label>
            <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" disabled value="{{$data['getKelasSiswa']->guru->telephone}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat Asli</label>
            <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" disabled value="{{$data['getKelasSiswa']->guru->alamat}}">
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
                <th style="text-align: center;">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['getNilai'] as $key => $value)
                <tr>
                  <td>{{date_format($value->created_at, 'd-M-Y')}}</td>
                  <td>{{$value->nama}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>
                    {{$value->nilai}} (
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
                    )
                  </td>
                  <td style="text-align: center;">
                    @if($value->nilai <= 50)
                      Wajib Mengulang
                    @elseif($value->nilai >= 51 && $value->nilai <= 60)
                      Mengulang
                    @elseif($value->nilai >= 61 && $value->nilai <= 70)
                      Boleh Mengulang
                    @elseif($value->nilai >= 71 && $value->nilai <= 100)
                      Lulus
                    @else
                      Tidak ada Nilai
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Daftar Tugas Dari Guru</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Matapelajaran</th>
                <th>Tugas</th>
                <th style="text-align: center;">Status</th>
                <th width="30" style="text-align: center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['getTugasGuru'] as $key => $value)
                <tr>
                  <td>{{date_format($value->created_at, 'd-M-Y')}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>{{$value->nama}}</td>
                  <td style="text-align: center;">
                    @if($value->status == NULL)
                      <button disabled class="btn btn-warning btn-sm">Belum Diberikan</button>
                    @elseif($value->status == '1')
                      <button disabled class="btn btn-success btn-sm">Sudah Diberikan</button>
                    @elseif($value->status == '0')
                      <button disabled class="btn btn-danger btn-sm">Tidak Ada</button>
                    @endif
                  </td>
                  <td>
                    @if($value->status == NULL)
                      <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$value->id}}" disabled>
                        </i>Kumpulkan
                      </button>
                      @elseif($value->status == '1')
                      <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$value->id}}">
                        </i>Kumpulkan
                      </button>
                      @elseif($value->status == '0')
                      <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$value->id}}" disabled>
                        </i>Kumpulkan
                      </button>
                    @endif
                    <div class="modal fade" id="edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="editTugas" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editTugas">Kumpulkan Tugas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="forms-sample" action="{{route('kumpulTugas')}}" method="post">
                              @csrf
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Tugas</label>
                                  <input name="" type="text" class="form-control" id="exampleInputEmail1" value="{{$value->nama}}" disabled>
                                  <input name="nama" type="hidden" class="form-control" id="exampleInputEmail1" value="{{$value->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Upload File</label>
                                  <input name="pdf" type="file" class="form-control" id="exampleInputEmail1">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Kumpulkan</button>
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

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tugas Terkumpulkan</h6>
        <div class="table-responsive">
          <table id="dataTableExample3" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Matapelajaran</th>
                <th>Tugas</th>
                <th style="text-align: center;">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['getTugasSiswa'] as $key => $value)
                <tr>
                  <td>{{date_format($value->created_at, 'd-M-Y')}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>{{$value->nama}}</td>
                  <td style="text-align: center;">
                    @if($value->status == NULL)
                      <button disabled class="btn btn-danger btn-sm">Tidak Ada</button>
                    @elseif($value->status == '1')
                      <button disabled class="btn btn-success btn-sm">Sudah Dinilai</button>
                    @elseif($value->status == '0')
                      <button disabled class="btn btn-warning btn-sm">Belum Dinilai</button>
                    @endif
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
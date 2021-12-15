@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Tugas</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Tugas</h6>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah Tugas
          </button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="forms-sample" action="{{route('tugas.store')}}" method="post">
                    @csrf
                    <input name="tanggal" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                    <input name="pdf" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                    <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Kelas Tersedia</label>
                        <select name="kelas_id" id="">
                            @foreach($data['getKelas'] as $key => $value)
                                <option value="{{$value->id}}">{{$value->matapelajaran->nama}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Tugas</label>
                        <input name="nama" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Tambah</button>
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
                <th width="10">No.</th>
                <th width="130" style="text-align: center;">Tanggal</th>
                <th>Kelas / Matapelajaran</th>
                <th>Nama Tugas</th>
                <th>Status</th>
                <th width="30" style="text-align: center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1;?>
              @foreach($data['getTugas'] as $key => $value)
                <tr>
                  <td>{{$n++}}</td>
                  <td style="text-align: center;">{{date_format($value->created_at, 'd-M-Y')}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>{{$value->nama}}</td>
                  <td>
                    @if($value->status == NULL)
                      Belum Diberikan
                      @elseif($value->status == '1')
                      Tugas Diberikan
                      @elseif($value->status == '0')
                      Tugas Ditutup
                    @endif
                  </td>
                  <td>
                    <form action="{{route('tugas.destroy', $value->id)}}" method="post">
                      <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$value->id}}">
                        <i class="btn-icon-prepend" data-feather="file"></i>Edit
                      </button>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-icon-text" ><i class="btn-icon-prepend" data-feather="trash"></i>Delete</button>
                    </form>
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
                            <form class="forms-sample" action="{{route('tugas.update', $value->id)}}" method="post">
                              @csrf
                              @method('PATCH')
                              <div class="form-group">
                                <label for="Kelas">Kelas / Matapelajaran</label>
                                <input name="" type="text" class="form-control" id="Kelas" autocomplete="off" value="{{$value->matapelajaran->nama}}" disabled>
                                <input name="matapelajaran_id" type="hidden" class="form-control" id="Kelas" autocomplete="off" value="{{$value->matapelajaran_id}}" >
                                <input name="guru_id" type="hidden" class="form-control" id="Kelas" autocomplete="off" value="{{$value->guru_id}}" >
                              </div>
                              <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input name="nama" type="text" class="form-control" id="Nama" autocomplete="off" value="{{$value->nama}}" >
                              </div>
                              <div class="form-group">
                                <label for="Status">Status</label>
                                <select name="status" class="form-control" id="Status" autocomplete="off">
                                  <option value="" <?php if($value->status == NULL): ?> selected <?php endif; ?>>Belum Diberikan</option>
                                  <option value="1" <?php if($value->status == '1'): ?> selected <?php endif; ?>>Tugas Diberikan</option>
                                  <option value="0" <?php if($value->status == '0'): ?> selected <?php endif; ?>>Tugas Ditutup</option>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Update</button>
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
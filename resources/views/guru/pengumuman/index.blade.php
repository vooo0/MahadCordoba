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
        Tambah
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="{{route('pengumuman.store')}}" method="post">
                        @csrf
                        <input name="tanggal" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                        <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="exampleInputPassword1">Judul</label>
                            <input name="nama" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Isi</label>
                            <input name="isi" type="text" class="form-control textarea" id="exampleInputPassword1" autocomplete="off">
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
                <th>Judul</th>
                <th>Isi</th>
                <th width="30" style="text-align: center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1;?>
              @foreach($data as $key => $value)
                <tr>
                  <td>{{$n++}}</td>
                  <td style="text-align: center;">{{date_format($value->created_at, 'd-m-Y')}}</td>
                  <td>{{$value->nama}}</td>
                  <td>{{$value->isi}}</td>
                  <td style="text-align: center;">
                    <form action="{{route('pengumuman.destroy', $value->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$value->id}}">
                        Edit
                      </button>
                      <button type="submit" class="btn btn-danger btn-icon-text" ><i class="btn-icon-prepend" data-feather="trash"></i>Delete</button>
                    </form>
                  </td>
                </tr>
                
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="forms-sample" action="{{route('pengumuman.update', $value->id )}}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <input name="tanggal" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                                    <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="">
                                    <div class="modal-body">
                                        <div class="form-group">
                                        <label for="exampleInputPassword1">Judul</label>
                                        <input name="nama" type="text" class="form-control" id="exampleInputPassword1" autocomplete="on" value="{{$value->nama}}">
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputPassword1">Isi</label>
                                        <input name="isi" type="text" class="form-control textarea" id="exampleInputPassword1" autocomplete="on" value="{{$value->isi}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
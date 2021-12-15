@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data matapelajaran</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data matapelajaran</h6>
        <p class="card-description">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah
        </button>
        </p>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('dataMatapelajaran.store')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputUsername1">Nama</label>
                    <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Tahun</label>
                    <input name="tahun" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan tahun" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Status</label>
                    <input name="status" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan status" >
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
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th width="10">No.</th>
                <th>Nama</th>
                <th>Tahun Pelajaran</th>
                <th>Status</th>
                <th width="150" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; ?>
              @foreach($data as $key => $matapelajaran)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{$matapelajaran->nama}}</td>
                  <td>{{$matapelajaran->tahun}}</td>
                  <td>{{$matapelajaran->status}}</td>
                  <td>
                    <form action="{{route('dataMatapelajaran.destroy', $matapelajaran->id)}}" method="post">
                      <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$matapelajaran->id}}">
                        <i class="btn-icon-prepend" data-feather="file"></i>Edit
                      </button>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-icon-text" ><i class="btn-icon-prepend" data-feather="trash"></i>Delete</button>
                    </form>
                    <div class="modal fade" id="edit{{$matapelajaran->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="forms-sample" action="{{route('dataMatapelajaran.update', $matapelajaran->id)}}" method="post">
                              @csrf
                              @method('PATCH')
                              <div class="form-group">
                                <label for="exampleInputUsername1">Nama</label>
                                <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$matapelajaran->nama}}" >
                              </div>
                              <div class="form-group">
                                <label for="exampleInputUsername1">Tahun</label>
                                <input name="tahun" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$matapelajaran->tahun}}" >
                              </div>
                              <div class="form-group">
                                <label for="exampleInputUsername1">Status</label>
                                <input name="status" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$matapelajaran->status}}" >
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
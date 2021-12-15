@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Siswa</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Matapelajaran</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Matapelajaran Diambil</h6>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah
        </button>
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
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <br>  
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th width="10">Nomor</th>
                <th>Matapelajaran</th>
                <th>Guru</th>
                <th>Telehpone</th>
                <th width="30" style="text-align: center" >Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; ?>
              @foreach($data as $key => $value)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{$value->matapelajaran->nama}}</td>
                  <td>{{$value->guru->nama}}</td>
                  <td>{{$value->guru->telephone}}</td>
                  <td style="text-align: center;">
                    <a href="{{route('matapelajaran.edit', $value->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="eye"></i>Detail</a>
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
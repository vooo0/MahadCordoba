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
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Daftar Siswa</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th width="10">No.</th>
                <th>Kelas</th>
                <th>Telephone</th>
                <th>Email</th>
                <th style="text-align: center;">Status</th>
                <th width="30" style="text-align: center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1;?>
              @foreach($data['getSiswa'] as $key => $value)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{$value->siswa->nama}}</td>
                  <td>{{$value->siswa->telephone}}</td>
                  <td>{{$value->siswa->email}}</td>
                  <td style="text-align: center;">{{$value->status}}</td>
                  <td style="text-align: center;">
                    <a href="{{route('matapelajaranGuru.edit', $value->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="eye"></i>Detail</a>
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
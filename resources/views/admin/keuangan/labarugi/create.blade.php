@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('labaRugi.index')}}">Data Laba Rugi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Pemasukkan</h6>
        <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach($getThisMonthIncome as $key => $income)
                <tr>
                    <td>{{date_format($income->created_at, "M-Y")}}</td>
                    <td>{{$income->nama}}</td>
                    <td>Rp. {{number_format($income->jumlahHarga, '2')}}</td>
                </tr>    
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Pengeluaran</h6>
        <table id="dataTableExample2" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            @foreach($getOutcome as $key => $outcome)
                <tr>
                    <td>{{date_format($outcome->created_at, "M-Y")}}</td>
                    <td>{{$outcome->nama}}</td>
                    <td>Rp. {{number_format($outcome->jumlahHarga,'2')}}</td>
                </tr>    
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Gaji</h6>
        <table id="dataTableExample3" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach($getGaji as $key => $gaji)
                <tr>
                    <td>{{date_format($gaji->created_at, "M-Y")}}</td>
                    <td>{{$gaji->nama}}</td>
                    <td>Rp. {{number_format($gaji->gaji, '2')}}</td>
                </tr>    
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="col-md-4 grid-margin stretch-card">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Tambah Data Laba / Rugi
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Laba / Rugi</h5>
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
  </div>


@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
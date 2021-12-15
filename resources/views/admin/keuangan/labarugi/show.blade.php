@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('labaRugi.index')}}">Data Laba Rugi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lihat Data</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Pemasukkan, dengan total Rp. {{number_format($getIncome->sum('jumlahHarga'))}}</h6>
        <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach($getIncome as $key => $income)
                <tr>
                    <td>{{date_format($income->created_at, "d-M-Y")}}</td>
                    <td>{{$income->nama}}</td>
                    <td>Rp. {{number_format($income->jumlahHarga)}}</td>
                </tr>    
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Pembayaran,  dengan total Rp. {{number_format($getPembayaran->sum('total'))}}</h6>
        <table id="dataTableExample2" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach($getPembayaran as $key => $pembayaran)
                <tr>
                    <td>{{date_format($pembayaran->created_at, "d-M-Y")}}</td>
                    <td>{{$pembayaran->nama}}</td>
                    <td>Rp. {{number_format($pembayaran->total)}}</td>
                </tr>    
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Pengeluaran,  dengan total Rp. {{number_format($getOutcome->sum('jumlahHarga'))}}</h6>
        <table id="dataTableExample3" class="table">
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
                    <td>{{date_format($outcome->created_at, "d-M-Y")}}</td>
                    <td>{{$outcome->nama}}</td>
                    <td>Rp. {{number_format($outcome->jumlahHarga)}}</td>
                </tr>    
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Gaji,  dengan total Rp. {{number_format($getGaji->sum('gaji'))}}</h6>
        <table id="dataTableExample4" class="table">
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
                    <td>{{date_format($gaji->created_at, "d-M-Y")}}</td>
                    <td>{{$gaji->nama}}</td>
                    <td>Rp. {{number_format($gaji->gaji)}}</td>
                </tr>    
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
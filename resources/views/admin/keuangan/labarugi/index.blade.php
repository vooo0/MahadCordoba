@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Laba Rugi</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Laba Rugi</h6>
        <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#modalPdf">
          <i class="btn-icon-prepend" data-feather="printer"></i>PDF
        </button>
        <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekap Data Laba Rugi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('labarugi.pdf')}}" method="post">
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
                <th>No.</th>
                <th>Tanggal Dibuat</th>
                <th>Keterangan</th>
                <th style="text-align: center">Total Pemasukkan</th>
                <th style="text-align: center">Total Pengeluaran</th>
                <th style="text-align: center">Total</th>
                <th style="text-align: center">Status</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=0; ?>
              @foreach($data as $key => $labaRugi)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{date_format($labaRugi->created_at, "d-M-Y")}}</td>
                  <td>{{$labaRugi->nama}}</td>
                  <td style="text-align: center">Rp. {{number_format($labaRugi->totalPemasukkan + $labaRugi->totalPembayaran)}}</td>
                  <td style="text-align: center">Rp. {{number_format($labaRugi->totalPengeluaran + $labaRugi->totalGaji)}}</td>
                  <td style="text-align: center">Rp. {{number_format($labaRugi->total)}}</td>
                  <td style="text-align: center">
                    <?php if($labaRugi->status == "Untung")
                    { echo "<i class='btn-icon-prepend' data-feather='check-circle'></i>"; }
                    elseif($labaRugi->status == "Rugi"){
                      echo "<i class='btn-icon-prepend' data-feather='alert-circle'></i>"; }
                    else{ 
                      echo "<i class='btn-icon-prepend' data-feather='copy'></i>"; } ?> 
                    {{$labaRugi->status}}
                  </td>
                  <td style="text-align: center">
                    <form action="{{route('labaRugi.destroy', $labaRugi->id)}}" method="post">
                    <a href="{{route('labaRugi.show', $labaRugi->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="eye"></i>Detail</a>
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
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if($getData == NULL)
          <form action="{{route('labaRugi.getMonth')}}" class="form-horizontal card-title" method="post">
            @csrf
            <input  type="hidden" name="getMonth" value="0000-00-00">
            <button type="submit" class="btn btn-primary">Tambah Data Bulan Ini</button>
          </form>
        @else
          <form action="{{route('labaRugi.updateThisMonth', $getData->id)}}" class="form-horizontal card-title" method="post">
            @csrf
            <input type="hidden" name='id' value="{{$getData->id}}">
            <input type="hidden" name='totalPemasukkan' value="{{$getData->totalPemasukkan}}">
            <input type="hidden" name='totalPembayaran' value="{{$getData->totalPembayaran}}">
            <input type="hidden" name='totalPengeluaran' value="{{$getData->totalPengeluaran}}">
            <input type="hidden" name='totalGaji' value="{{$getData->totalGaji}}">
            <input type="hidden" name='nama' value="{{$getData->nama}}">
            <input type="hidden" name='total' value="{{$getData->total}}">
            <input type="hidden" name='status' value="{{$getData->status}}">
            <input type="hidden" name='created_at' value="{{$getData->created_at}}">
            <input type="hidden" name='updated_at' value="{{$getData->updated_at}}">
            <button type="submit" class="btn btn-primary">Update Data Bulan Ini</button>
          </form>
        @endif
        <p>
          <a href="{{route('labaRugi.create')}}" class="btn btn-primary">Cek Pengeluaran dan Pemasukkan </a>
        </p>
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
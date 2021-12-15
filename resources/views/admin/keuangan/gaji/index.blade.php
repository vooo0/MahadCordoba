@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Gaji dan Admin (Karyawan)</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Guru</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Nomor Telephone</th>
                <th>E-mail</th>
                <th style="text-align:center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($getGuru as $key => $guru)
                <tr>
                  <td>{{$guru->nama}}</td>
                  <td>
                    @if($guru->telephone == NULL)
                      Tidak Diisi
                    @endif
                    {{$guru->telephone}}
                  </td>
                  <td>
                    @if($guru->email == NULL)
                      Tidak Diisi
                    @endif
                    {{$guru->email}}
                  </td>
                  <td style="text-align:center">
                    <a href="{{route('gajiGuru.edit', $guru->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="eye"></i>Lihat</a>
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
        <h6 class="card-title">Data Admin / Karyawan</h6>
        <div class="table-responsive">
          <table id="dataTableExample2" class="table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Nomor Telephone</th>
                <th>E-mail</th>
                <th style="text-align:center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($getAdmin as $key => $admin)
                <tr>
                  <td>{{$admin->nama}}</td>
                  <td>
                    @if($admin->telephone == NULL)
                      Tidak Diisi
                    @endif
                    {{$admin->telephone}}
                  </td>
                  <td>
                    @if($admin->email == NULL)
                      Tidak Diisi
                    @endif
                    {{$admin->telephone}}
                  </td>
                  <td style="text-align:center">
                    <a href="{{route('gajiAdmin.show', $admin->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="eye"></i>Lihat</a>
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
        <h6 class="card-title">Data Gaji</h6>
        <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#modalPdf">
          <i class="btn-icon-prepend" data-feather="printer"></i>PDF
        </button>
        <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekap Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('gajiKeuangan.pdf')}}" method="post">
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
          <table id="dataTableExample3" class="table">
            <thead>
              <tr>
                <th width="10">No.</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th style="text-align:center;">Total Gaji</th>
                <th style="text-align:center;">Status</th>
                <th width="30" style="text-align:center;">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; ?>
              @foreach($data as $key => $gaji)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{date_format($gaji->created_at, 'M-Y')}}</td>
                  <td>{{$gaji->nama}}</td>
                  <td style="text-align:center;">Rp. {{number_format($gaji->gaji, '2')}}</td>
                  <td style="text-align:center;">{{$gaji->status}}</td>
                  <td style="text-align:center">
                    <form action="{{route('gaji.destroy', $gaji->id)}}" method="post">
                      <a href="{{route('gaji.show', $gaji->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="file"></i>Edit</a>
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

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
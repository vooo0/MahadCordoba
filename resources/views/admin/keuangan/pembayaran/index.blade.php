@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data bayar</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data bayar</h6>
        <p class="card-description">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah
        </button>
        <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#modalPdf">
          <i class="btn-icon-prepend" data-feather="printer"></i>PDF
        </button>
        <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekap Data Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('pembayaranKeuangan.pdf')}}" method="post">
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
        </p>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('pembayaranSiswa.store')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputUsername1">Calon Siswa</label>
                    <select name="pendaftaran_id" class="form-control">
                      <option selected></option>
                      @foreach($getPendaftaran as $key => $gp)
                        <option value="{{$gp->id}}">{{$gp->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Siswa</label>
                    <select name="siswa_id" class="form-control">
                      <option selected> </option>
                      @foreach($getSiswa as $key => $gs)
                        <option value="{{$gs->id}}">{{$gs->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Keterangan</label>
                    <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Keterangan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Total Bayar</label>
                    <input name="total" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nominal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Tanggal</label>
                    <input name="tanggal" type="date" class="form-control" id="exampleInputUsername1" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Status</label>
                    <input name="status" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Status Pembayaran">
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
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Oleh</th>
                <th>total</th>
                <th>Status</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; ?>
              @foreach($data as $key => $bayar)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{date_format($bayar->created_at, 'd-M-Y')}}</td>
                  <td>{{$bayar->nama}}</td>
                  <td>
                    @if($bayar->siswa_id != NULL && $bayar->pendaftaran_id == NULL)
                    {{$bayar->siswa->nama}}
                    @elseif($bayar->siswa_id == NULL && $bayar->pendaftaran_id != NULL)
                    {{$bayar->pendaftaran->nama}}
                    @endif
                  </td>
                  <td>
                      Rp. {{number_format($bayar->total)}}
                  </td>
                  <td>
                      {{$bayar->status}}
                  </td>
                  <td>
                    <form action="{{route('pembayaran.destroy', $bayar->id)}}" method="post">
                      <button type="button"  class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$bayar->id}}">
                        <i class="btn-icon-prepend" data-feather="file"></i>Edit
                      </button>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-icon-text" ><i class="btn-icon-prepend" data-feather="trash"></i>Delete</button>
                    </form>
                      <div class="modal fade" id="edit{{$bayar->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editLabel">Edit Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="forms-sample" action="{{route('pembayaran.update', $bayar->id)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Siswa</label>
                                    <select name="siswa_id" class="form-control">
                                        @foreach($getSiswa as $key => $gs)
                                        <option value="{{$gs->id}}">{{$gs->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Siswa Pendaftaran</label>
                                    <select name="siswa_id" class="form-control">
                                        @foreach($getPendaftaran as $key => $gp)
                                        <option value="{{$gp->id}}">{{$gp->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama</label>
                                    <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Total Bayar</label>
                                    <input name="total" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nominal">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tanggal</label>
                                    <input name="tanggal" type="date" class="form-control" id="exampleInputUsername1" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Status</label>
                                    <input name="status" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Status Pembayaran">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
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

  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>

  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
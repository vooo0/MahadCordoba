@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data pengeluaran</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data pengeluaran</h6>
        <p class="card-description">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah
        </button>
        <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#modalPdf">
          <i class="btn-icon-prepend" data-feather="printer"></i>PDF
        </button>
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
                <form class="forms-sample" action="{{route('pengeluaran.store')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputUsername1">Nama</label>
                    <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Dari</label>
                    <input name="dari" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan dari" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Jumlah Benda</label>
                    <input name="jumlahBenda" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Jumlah Benda" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Jumlah Harga</label>
                    <input name="jumlahHarga" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Jumlah Harga" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Status</label>
                    <select name="status" class="form-control">
                      <option value="">Pilih Status Penerimaan</option>
                      <option value="diterima">Diterima</option>
                      <option value="ditolak">Ditolak</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekap Data Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="forms-sample" action="{{route('pengeluaran.pdf')}}" method="post">
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
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th width="10">No.</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Dari</th>
                <th>Jumlah Benda</th>
                <th>Jumlah Harga</th>
                <th>Status</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; ?>
              @foreach($data as $key => $pengeluaran)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{date_format($pengeluaran->created_at, 'd-M-Y')}}</td>
                  <td>{{$pengeluaran->nama}}</td>
                  <td>
                    @if(!empty($pengeluaran->dari))
                      {{$pengeluaran->dari}}
                      @else
                      Tidak Dicantumkan
                      @endif
                  </td>
                  <td>
                    @if(!empty($pengeluaran->jumlahBenda))
                    {{$pengeluaran->jumlahBenda}} Buah
                    @else
                      Bukan Barang
                    @endif
                  </td>
                  <td>
                    @if(!empty($pengeluaran->jumlahHarga))
                    Rp. {{number_format($pengeluaran->jumlahHarga, '2')}}
                    @else
                      Belum Dinilai
                    @endif
                  </td>
                  <td>
                    @if(!empty($pengeluaran->status))
                    {{$pengeluaran->status}}
                    @else
                      Belum Diisi
                    @endif
                  </td>
                  <td>
                    <form action="{{route('pengeluaran.destroy', $pengeluaran->id)}}" method="post">
                      <button type="button"  class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#edit{{$pengeluaran->id}}">
                        <i class="btn-icon-prepend" data-feather="file"></i>Edit
                      </button>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-icon-text" ><i class="btn-icon-prepend" data-feather="trash"></i>Delete</button>
                    </form>
                      <div class="modal fade" id="edit{{$pengeluaran->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editLabel">Edit Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="forms-sample" action="{{route('pengeluaran.update', $pengeluaran->id)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Nama</label>
                                  <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" value="{{$pengeluaran->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Dari</label>
                                  <input name="dari" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan dari" value="{{$pengeluaran->dari}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Jumlah Benda</label>
                                  <input name="jumlahBenda" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Jumlah Benda" value="{{$pengeluaran->jumlahBarang}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Jumlah Harga</label>
                                  <input name="jumlahHarga" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Jumlah Harga" value="{{$pengeluaran->jumlahHarga}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Status</label>
                                  <select name="status" class="form-control">
                                    @if($pengeluaran->status == 'diterima')
                                      <option value="">Pilih Status Penerimaan</option>
                                      <option value="diterima" selected>Diterima</option>
                                      <option value="ditolak">Ditolak</option>
                                    @elseif($pengeluaran->status == 'ditolak')
                                      <option value="">Pilih Status Penerimaan</option>
                                      <option value="diterima">Diterima</option>
                                      <option value="ditolak" selected>Ditolak</option>
                                    @else
                                      <option value="">Pilih Status Penerimaan</option>
                                      <option value="diterima">Diterima</option>
                                      <option value="ditolak">Ditolak</option>
                                    @endif
                                  </select>
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
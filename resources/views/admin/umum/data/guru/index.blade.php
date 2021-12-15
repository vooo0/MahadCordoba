@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Guru</h6>
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
                <form class="forms-sample" action="{{route('dataGuru.store')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputUsername1">Nama</label>
                    <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Email" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telephone</label>
                    <input  name="telephone" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Nomor Telephone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input  name="alamat" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Alamat">
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select name="jenisKelamin" class="form-control form-control-sm mb-3">
                      <option selected>Pilih Gender</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Foto</label>
                    <input name="foto" type="file" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Upload Foto">
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
                <th>Email</th>
                <th>Telephone</th>
                <th width="30" style="text-align: center">Menu</th>
              </tr>
            </thead>
            <tbody>
              <?php $n=1; ?>
              @foreach($data as $key => $guru)
                <tr>
                  <td>{{$n++}}</td>
                  <td>{{$guru->nama}}</td>
                    @if(!empty($guru->email))
                    
                    @endif
                  <td>
                    @if(!empty($guru->email))
                      {{$guru->email}}
                      @else
                      Belum Diisi
                      @endif
                  </td>
                  <td>
                    @if(!empty($guru->telephone))
                    {{$guru->telephone}}
                    @else
                      Belum Diisi
                    @endif
                  </td>
                  <td>
                    <form action="{{route('dataGuru.destroy', $guru->id)}}" method="post">
                      <a href="{{route('dataGuru.edit', $guru->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="file"></i>Edit</a>
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
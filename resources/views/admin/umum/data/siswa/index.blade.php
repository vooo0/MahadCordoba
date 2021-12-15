  @extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Siswa</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Nomor Telephone</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key => $siswa)
                <tr>
                  <td>{{$siswa->nama}}</td>
                  <td>{{$siswa->telephone}}</td>
                  <td>{{$siswa->email}}</td>
                  <td>{{$siswa->jenisKelamin}}</td>
                  <td>
                    <form action="{{route('dataSiswa.destroy', $siswa->id)}}" method="post">
                      <a href="{{route('dataSiswa.edit', $siswa->id)}}" class="btn btn-primary btn-icon-text" ><i class="btn-icon-prepend" data-feather="file"></i>Edit</a>
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
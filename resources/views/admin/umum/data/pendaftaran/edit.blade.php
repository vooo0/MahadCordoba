@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data pendaftar</li>
  </ol>
</nav>


<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update Data Calon Siswa : {{$data->nama}}</h6>
                <form action="{{route('pendaftaran.update', $data->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input name="nama" type="text" class="form-control" value="{{$data->nama}}">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                                <input name="email" type="email" class="form-control" value="{{$data->email}}">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label class="control-label">Nomor Telephone</label>
                            <input name="telephone" type="text" class="form-control" value="{{$data->telephone}}">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label class="control-label">Tanggal Lahir</label>
                            <input name="tanggalLahir" type="date" class="form-control" value="{{$data->tanggalLahir}}">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label class="control-label">Gender</label>
                            <Select name="jenisKelamin">
                                <Option>Pilih Gender</Option>
                                <Option value="laki-laki" <?php if($data->jenisKelamin == 'laki-laki'): ?> selected <?php endif; ?>> Laki-Laki </Option>
                                <Option value="perempuan" <?php if($data->jenisKelamin == 'perempuan'): ?> selected <?php endif; ?>> Perempuan </Option>
                            </Select>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label class="control-label">Foto Ktp</label>
                            <input name="foto" type="file" class="form-control" value="{{$data->foto}}">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label class="control-label">Stattus KTP</label>
                            <Select name="statusKtp">
                                <Option>Pilih Status</Option>
                                <Option value="lajang" <?php if($data->statusKtp == 'lajang'): ?> selected <?php endif; ?>> Lajang / Belum Menikah </Option>
                                <Option value="menikah" <?php if($data->statusKtp == 'menikah'): ?> selected <?php endif; ?>> Menikah </Option>
                            </Select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                            <label class="control-label">Pendidikan Terakhir</label>
                            <Select name="pendidikan">
                                <option selected>Pilih Pendidikan Terkahir</option>
                                <option value="tidak sekolah" <?php if($data->pendidikan == 'tidak sekolah'): ?> selected <?php endif; ?>>Tidak Sekolah</option>
                                <option value="SD" <?php if($data->pendidikan == 'SD'): ?> selected <?php endif; ?>>Sekolah Dasar (SD)</option>
                                <option value="SMP" <?php if($data->pendidikan == 'SMP'): ?> selected <?php endif; ?>>Sekolah Menengah Pertama (SMP)</option>
                                <option value="SMA" <?php if($data->pendidikan == 'SMA'): ?> selected <?php endif; ?>>Sekolah Menengah Akhir / Sekolah Menengah Kejurusan (SMA/SMK)</option>
                                <option value="S1" <?php if($data->pendidikan == 'S1'): ?> selected <?php endif; ?>>Unicersitas Lulusan Sarjana (SI)</option>
                                <option value="S2" <?php if($data->pendidikan == 'S2'): ?> selected <?php endif; ?>>Unicersitas Lulusan Magister (S2)</option>
                                <option value="s3" <?php if($data->pendidikan == 'S3'): ?> selected <?php endif; ?>>Unicersitas Lulusan Doktor (S3)</option>
                            </Select>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label">Alamat Asli</label>
                            <input name="alamatAsli" type="text" class="form-control" value="{{$data->alamatAsli}}">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label">Alamat Sekarang</label>
                            <input  name="alamatSekarang" type="text" class="form-control" value="{{$data->alamatSekarang}}">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label">Alasan</label>
                            <input name="alasan" type="text" class="form-control" value="{{$data->alasan}}">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label">Moto</label>
                            <input  name="moto" type="text" class="form-control" value="{{$data->moto}}">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label class="control-label">Status Penerimaan</label>
                            <Select name="status">
                                <Option>Pilih Status</Option>
                                <Option value="0" <?php if($data->status == '0'): ?> selected <?php endif; ?>> Tidak Diterima </Option>
                                <Option value="1" <?php if($data->status == '1'): ?> selected <?php endif; ?>> Belum Dikonfirmasi </Option>
                                <Option value="2" <?php if($data->status == '2'): ?> selected <?php endif; ?>> Diterima </Option>
                            </Select>
                            </div>
                        </div>
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary submit">Update</button>
                </form>
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
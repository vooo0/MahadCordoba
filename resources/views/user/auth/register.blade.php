@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-10 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-6 pl-md-0 mx-auto">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">Ma'had<span>Cordoba</span></a>
              <h5 class="text-muted font-weight-normal mb-4">Daftar Untuk Belajar Bahasa Arab Bersama Kami.</h5>
              <form class="forms-sample" action="{{route('daftarBaru')}}" method="post">
                @csrf
                <input name="status" type="hidden" class="form-control" id="exampleInputUsername1" autocomplete="off" value="1">
                <div class="row">
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Nama</label>
                      <input name="nama" type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Masukkan Nama" >
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Email" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Telephone</label>
                      <input  name="telephone" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Nomor Telephone">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Lahir</label>
                      <input  name="tanggalLahir" type="date" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Tanggal Lahir">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat Asli</label>
                  <input  name="alamatAsli" type="textArea" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Alamat Asli">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat Sekarang</label>
                  <input  name="alamatSekarang" type="textArea" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan Alamat Sekarang">
                </div>
                <div class="row">
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label>Gender</label>
                      <select name="jenisKelamin" class="form-control form-control-sm mb-3">
                        <option selected>Pilih Gender</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label>Pendidikan Terakhir</label>
                      <select name="pendidikan" class="form-control form-control-sm mb-3">
                        <option selected>Pilih Pendidikan Terkahir</option>
                        <option value="tidak sekolah">Tidak Sekolah</option>
                        <option value="SD">Sekolah Dasar (SD)</option>
                        <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                        <option value="SMA">Sekolah Menengah Akhir / Sekolah Menengah Kejurusan (SMA/SMK)</option>
                        <option value="S1">Unicersitas Lulusan Sarjana (SI)</option>
                        <option value="S2">Unicersitas Lulusan Magister (S2)</option>
                        <option value="S3">Unicersitas Lulusan Doktor (S3)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pl-md-0 mx-auto">
                    <div class="form-group">
                      <label>Stauts KTP</label>
                      <select name="statusKtp" class="form-control form-control-sm mb-3">
                        <option selected>Pilih Status</option>
                        <option value="lajang">Lajang / Belum Menikah</option>
                        <option value="menikah">Menikah</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-0 mx-auto">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Foto KTP</label>
                        <input name="fotoKtp" type="file" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Upload Foto">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alasan</label>
                  <input name="alasan" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Alasan Anda Belajar Bahasa Arab">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">MOTO</label>
                  <input name="moto" type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="MOTO Hidup Anda">
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Daftar</button>
                <a href="{{ url('/login') }}" class="d-block mt-3 text-muted">Already a user?<br> Sign in</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
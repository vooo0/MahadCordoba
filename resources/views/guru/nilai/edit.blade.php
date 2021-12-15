@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Nilai Rapor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Siswa</li>
  </ol>
</nav>

<div class="row" id="cetak">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-3 pl-0">
            <a href="#" class="noble-ui-logo d-block mt-3">Ma'Had<span>Cordoba</span></a>                 
            <p class="mt-1 mb-1"><b>Tempat Belajar Bahasa Arab</b></p>
            <p>kodepos,<br> alamat,<br>Kota Malang, nomor rumah.</p>
            <h5 class="mt-5 mb-2 text-muted">Rapor Untuk :</h5>
            <p>{{$data['getKelas']->siswa->nama}},<br>{{$data['getKelas']->siswa->alamatAsli}},<br> {{$data['getKelas']->siswa->alamatSekarang}}.</p>
          </div>
          <div class="col-lg-3 pr-0">
            <h4 class="font-weight-medium text-uppercase text-right mt-4 mb-2">Rapor</h4>
            <h6 class="text-right mb-5 pb-4"># {{$data['today']}}</h6>
            <p class="text-right mb-1">Rata-rata</p>
            <h4 class="text-right font-weight-normal">{{$data['getNilai']->avg('nilai')}}</h4>
            <h6 class="mb-0 mt-3 text-right font-weight-normal mb-2"><span class="text-muted">Kelas :</span> {{$data['getKelas']->matapelajaran->nama}}</h6>
            <h6 class="text-right font-weight-normal"><span class="text-muted">Guru :</span> {{$data['getKelas']->guru->nama}}</h6>
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Keterangan</th>
                      <th class="text-right">Nilai</th>
                      <th class="text-right">Nilai</th>
                      <th class="text-right">Status</th>
                      <th class="text-right">Keterangan</th>
                    </tr>
                </thead>
                <tbody><?php $n=1; ?>
                    @foreach($data['getNilai'] as $key => $value)
                        <tr class="text-right">
                            <td class="text-left">{{$n++}}</td>
                            <td class="text-left">{{$value->nama}}</td>
                            <td>{{$value->nilai}}</td>
                            <td>
                                @if($value->nilai < 50)
                                F
                                @elseif($value->nilai >= 50 && $value->nilai < 60)
                                E
                                @elseif($value->nilai >= 60 && $value->nilai < 70)
                                D
                                @elseif($value->nilai >= 70 && $value->nilai < 80)
                                C
                                @elseif($value->nilai >= 80 && $value->nilai < 90)
                                B
                                @elseif($value->nilai >= 90 && $value->nilai < 100)
                                A
                                @endif
                            </td>
                            <td>
                                @if($value->nilai < 60)
                                Tidak Lulus
                                @elseif($value->nilai >= 60 && $value->nilai <= 100)
                                Lulus
                                @endif
                            </td>
                            <td>
                                @if($value->status == '1')
                                Sudah Dinilai
                                @elseif($value->status == '0')
                                Belum Dinilai
                                @else
                                Tidak Mengumpulkan Tugas
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ml-auto">
                <div class="table-responsive">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>Total Nilai</td>
                          <td class="text-right">{{$data['getNilai']->sum('nilai')}}</td>
                        </tr>
                        <tr>
                          <td>Rata-Rata Nilai</td>
                          <td class="text-right">{{$data['getNilai']->avg('nilai')}}</td>
                        </tr>
                        <tr>
                          <td class="text-bold-800">Status</td>
                          <td class="text-bold-800 text-right">
                            @if($data['getNilai']->sum('nilai') < 60)
                                Tidak Lulus
                            @elseif($data['getNilai']->sum('nilai') >= 60 && $data['getNilai']->sum('nilai') <= 100)
                                Lulus
                            @endif
                        </td>
                        </tr>
                        <tr class="bg-light">
                          <td>Keterangan</td>
                        @if($data['getNilai']->sum('nilai') < 60)
                          <td class="text-danger text-right text-bold-800">
                            Bisa Mengulang atau Remidial Untuk Mendapatkan Nilai Yang Lebih Tinggi
                          </td>
                        @elseif($data['getNilai']->sum('nilai') >= 60 && $data['getNilai']->sum('nilai') <= 100)
                          <td class="text-success text-right text-bold-800">
                            Tidak Perlu Mengikuti Remidial atau Mengulang
                          </td>
                        @endif
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        <div class="container-fluid w-100">
            <form>
                <input type="button" class="btn btn-outline-primary float-right mt-4" value="Print" onclick="print()">
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script type="text/javascript">
        
    function print(){
      var print_div = document.getElementById("cetak");
        var print_area = window.open();
        print_area.document.write(print_div.innerHTML);
        print_area.document.close();
        print_area.focus();
        print_area.print();
        print_area.close();
    }
  </script>
@endpush
<!DOCTYPE html>
<html>
<head>
	<title>Data Pendaftaran Ma'Had Cordoba ({{$data['thisMonth']}}-{{$data['thisYear']}})</title>
    
    <style>
        table, td, th {
            border: 1px solid black;
        } 
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th{
            height: 50px;
            text-align: center;
          }
          td {
            height: 5px;
            text-align: center;
            font-size: 12px;
        }
        p {
          font-size: 12px;
        }
    </style>
</head>
<body>

	<center>
		<h2>LAPORAN DATA PENERIMAAN</h2>
		<h4 style="margin-top: -15px">CALON SANTRI MA'HAD CORDOBA</h4>
		<h5>Pada <b>{{$data['dateStart']}}</b> Sampai <b>{{$data['dateEnd']}}</b></h5>
	</center>

	<br/>
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Telephone</th>
            <th>Alamat</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @if($data['getPendaftaran'] != NULL )
            @foreach($data['getPendaftaran'] as $key => $pendaftar)
              <tr>
                <td>{{$pendaftar->nama}}</td>
                <td>
                  @if(!empty($pendaftar->telephone))
                  {{$pendaftar->telephone}}
                  @else
                    Belum Diisi
                  @endif
                </td>
                <td>
                  @if(!empty($pendaftar->alamatSekarang))
                  {{$pendaftar->alamatSekarang}}
                  @else
                    Belum Diisi
                  @endif
                </td>
                <td>
                  @if($pendaftar->status == '1')
                    <p class="btn btn-warning">Belum Dikonfirmasi</p>
                  @elseif($pendaftar->status == '2')
                    <p class="btn btn-success">Diterima</p>
                  @else
                    <p class="btn btn-danger">Ditolak</p>
                  @endif
                </td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="4"><b>Data Tidak Ada</b></td>
          </tr>
          @endif
        </tbody>
      </table>

      <div class="keterangan">
        <br><b>Keterangan</b>
        <p style="margin-bottom:-10px;">Total Pendaftar: {{$data['getPendaftaran']->count()}} Siswa</p>
        <p style="margin-bottom:-10px;">Pendaftar Diterima: {{$data['getPendaftaran']->where('status', '2')->count()}} Siswa</p>
        <p style="margin-bottom:-10px;">Pendaftar Ditolak: {{$data['getPendaftaran']->where('status', '0')->count()}} Siswa</p>
        <p style="margin-bottom:-10px;">Pendaftar Belum Dikonfirmasi: {{$data['getPendaftaran']->where('status', '1')->count()}} Siswa</p>
      </div>
	<script>
		window.print();
	</script>
	
</body>
</html>
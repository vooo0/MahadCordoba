<!DOCTYPE html>
<html>
<head>
	<title>Data pembayaran Ma'Had Cordoba ({{$data['thisMonth']}}-{{$data['thisYear']}})</title>
    
    <style>
        table, td, th {
            border: 1px solid black;
        } 
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th{
            height: 25px;
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
		<h2>LAPORAN DATA PEMBAYARAN SISWA DAN CALON SISWA</h2>
		<h4 style="margin-top: -15px">MA'HAD CORDOBA</h4>
		<h5>Pada <b>{{$data['dateStart']}}</b> Sampai <b>{{$data['dateEnd']}}</b></h5>
	</center>

	<br/>
      <table>
        <thead>
          <tr>
            <th>tanggal</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>pembayaran</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @if($data['getPembayaran'] != NULL )
            @foreach($data['getPembayaran'] as $key => $pembayaran)
              <tr>
                <td>{{date_format($pembayaran->created_at, 'd-M-Y')}}</td>
                <td>
                    @if($pembayaran->siswa_id != NULL && $pembayaran->pendaftaran_id == NULL)
                        {{$pembayaran->siswa->nama}}
                    @elseif($pembayaran->pendaftaran_id != NULL && $pembayaran->siswa_id == NULL)
                        {{$pembayaran->pendaftaran->nama}}
                    @endif
                </td>
                <td>{{$pembayaran->nama}}</td>
                <td>Rp.{{number_format($pembayaran->total)}}</td>
                <td>{{$pembayaran->status}}</td>
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
        <p style="margin-bottom:-10px;">Total Data pembayaran: {{$data['getPembayaran']->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Data pembayaran Admin: {{$data['getPembayaran']->where('siswa_id', '!=', NULL)->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Data pembayaran Guru: {{$data['getPembayaran']->where('pendaftaran_id', '!=', NULL)->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total pembayaran: Rp.{{number_format($data['getPembayaran']->sum('total'))}}</p>
      </div>
	<script>
		window.print();
	</script>
	
</body>
</html>
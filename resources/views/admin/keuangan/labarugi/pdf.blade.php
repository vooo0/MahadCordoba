<!DOCTYPE html>
<html>
<head>
	<title>Data Laba Rugi Ma'Had Cordoba ({{$data['thisMonth']}}-{{$data['thisYear']}})</title>
    
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
		<h2>LAPORAN DATA LABA / RUGI</h2>
		<h4 style="margin-top: -15px">MA'HAD CORDOBA</h4>
		<h5>Pada <b>{{$data['dateStart']}}</b> Sampai <b>{{$data['dateEnd']}}</b></h5>
	</center>

	<br/>
      <table>
        <thead>
          <tr>
            <th>tanggal</th>
            <th>Keterangan</th>
            <th>Total Pemasukkan</th>
            <th>Total Penngeluaran</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @if($data['getLabarugi'] != NULL )
            @foreach($data['getLabarugi'] as $key => $labarugi)
              <tr>
                <td>{{date_format($labarugi->created_at, 'd-M-Y')}}</td>
                <td>{{$labarugi->nama}}</td>
                <td>Rp.{{number_format($labarugi->totalPemasukkan)}}</td>
                <td>Rp.{{number_format($labarugi->totalPengeluaran)}}</td>
                <td>Rp.{{number_format($labarugi->total)}}</td>
                <td>{{$labarugi->status}}</td>
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
        <p style="margin-bottom:-10px;">Total Data Laba Rugi: {{$data['getLabarugi']->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Laba: Rp.{{number_format($data['getLabarugi']->sum('total'))}}</p>
        <p style="margin-bottom:-10px;">Total Rugi Guru: Rp.{{number_format($data['getLabarugi']->sum('total'))}}</p>
        <p style="margin-bottom:-10px;">Total Keseluruhan: Rp.{{number_format($data['getLabarugi']->sum('total'))}}</p>
      </div>
	<script>
		window.print();
	</script>
	
</body>
</html>
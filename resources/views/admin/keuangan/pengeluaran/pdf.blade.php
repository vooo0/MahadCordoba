<!DOCTYPE html>
<html>
<head>
	<title>Data Pengeluaran Ma'Had Cordoba ({{$data['thisMonth']}}-{{$data['thisYear']}})</title>
    
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
		<h2>LAPORAN DATA PENGELUARAN</h2>
		<h4 style="margin-top: -15px">MA'HAD CORDOBA</h4>
		<h5>Pada <b>{{$data['dateStart']}}</b> Sampai <b>{{$data['dateEnd']}}</b></h5>
	</center>

	<br/>
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Dari</th>
            <th>Jumlah</th>
            <th>Nominal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @if($data['getPengeluaran'] != NULL )
            @foreach($data['getPengeluaran'] as $key => $pengeluaran)
              <tr>
                <td>{{$pengeluaran->nama}}</td>
                <td>{{$pengeluaran->dari}}</td>
                <td>{{$pengeluaran->jumlahBenda}} Buah</td>
                <td>Rp.{{number_format($pengeluaran->jumlahHarga)}}</td>
                <td>{{$pengeluaran->status}}</td>
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
        <p style="margin-bottom:-10px;">Total Data pengeluaran: {{$data['getPengeluaran']->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Barang: {{number_format($data['getPengeluaran']->where('jumlahBenda', '!=', NULL)->count())}} Data</p>
        <p style="margin-bottom:-10px;">Total pengeluaran: Rp.{{number_format($data['getPengeluaran']->sum('jumlahHarga'))}}</p>
      </div>
	<script>
		window.print();
	</script>
	
</body>
</html>
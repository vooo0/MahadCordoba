<!DOCTYPE html>
<html>
<head>
	<title>Data Pemasukkan Ma'Had Cordoba ({{$data['thisMonth']}}-{{$data['thisYear']}})</title>
    
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
		<h2>LAPORAN DATA PEMASUKKAN</h2>
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
          @if($data['getPemasukkan'] != NULL )
            @foreach($data['getPemasukkan'] as $key => $pemasukkan)
              <tr>
                <td>{{$pemasukkan->nama}}</td>
                <td>{{$pemasukkan->dari}}</td>
                <td>{{$pemasukkan->jumlahBenda}} Buah</td>
                <td>Rp.{{number_format($pemasukkan->jumlahHarga)}}</td>
                <td>{{$pemasukkan->status}}</td>
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
        <p style="margin-bottom:-10px;">Total Data Pemasukkan: {{$data['getPemasukkan']->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Barang: {{number_format($data['getPemasukkan']->where('jumlahBenda', '!=', NULL)->count())}} Data</p>
        <p style="margin-bottom:-10px;">Total Pemasukkan: Rp.{{number_format($data['getPemasukkan']->sum('jumlahHarga'))}}</p>
      </div>
	<script>
		window.print();
	</script>
	
</body>
</html>
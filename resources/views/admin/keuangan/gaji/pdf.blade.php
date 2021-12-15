<!DOCTYPE html>
<html>
<head>
	<title>Data gaji Ma'Had Cordoba ({{$data['thisMonth']}}-{{$data['thisYear']}})</title>
    
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
		<h2>LAPORAN DATA GAJI KARYAWAN DAN GURU</h2>
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
            <th>Kehadiran</th>
            <th>Gaji</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @if($data['getGaji'] != NULL )
            @foreach($data['getGaji'] as $key => $gaji)
              <tr>
                <td>{{date_format($gaji->created_at, 'd-M-Y')}}</td>
                <td>
                    @if($gaji->guru_id != NULL && $gaji->admin_id == NULL)
                        {{$gaji->guru->nama}}
                    @elseif($gaji->admin_id != NULL && $gaji->guru_id == NULL)
                        {{$gaji->admin->nama}}
                    @endif
                </td>
                <td>{{$gaji->nama}}</td>
                <td>{{$gaji->kehadiran}} Kali</td>
                <td>Rp.{{number_format($gaji->gaji)}}</td>
                <td>{{$gaji->status}}</td>
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
        <p style="margin-bottom:-10px;">Total Data gaji: {{$data['getGaji']->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Data Gaji Admin: {{$data['getGaji']->where('guru_id', '!=', NULL)->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Data Gaji Guru: {{$data['getGaji']->where('admin_id', '!=', NULL)->count()}} Data</p>
        <p style="margin-bottom:-10px;">Total Gaji: Rp.{{number_format($data['getGaji']->sum('gaji'))}}</p>
      </div>
	<script>
		window.print();
	</script>
	
</body>
</html>
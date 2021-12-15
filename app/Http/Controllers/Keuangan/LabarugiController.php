<?php

namespace App\Http\Controllers\Keuangan;

use App\Gaji;
use App\Http\Controllers\Controller;
use App\Labarugi;
use App\Pemasukkan;
use App\Pembayaran;
use App\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Labarugi::all();
        $getData = Labarugi::whereMonth('created_at', Carbon::today()->format('m'))->first();
        // dd($getData);
        return view('admin.keuangan.labarugi.index', compact('data', 'getData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getIncome = Pemasukkan::all();
        $getOutcome = Pengeluaran::all();
        $getGaji = Gaji::all();
        $getThisMonthIncome = pemasukkan::whereMonth('created_at', '=', '08')->get();
        return view('admin.keuangan.labarugi.create', compact('getIncome', 'getOutcome', 'getGaji', 'getThisMonthIncome'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function pdf(Request $request)
    {
        $data['dateStart'] = $request->dateStart;
        $data['dateEnd'] = $request->dateEnd;
        $data['thisMonth'] = $request->dateEnd;
        $data['thisYear'] = $request->dateEnd;
        $data['getLabarugi'] = Labarugi::whereBetween('created_at', [$data['dateStart'], $data['dateEnd']])->get();
        // dd($data);
        return view('admin.keuangan.labarugi.pdf', compact('data'));
    }
    
    public function getMonth(Request $request)
    {
        $bulan = Carbon::today()->month;
        $tahun = Carbon::today()->year;
        $income = Pemasukkan::whereMonth('created_at', '=', Carbon::today()->month)->get('jumlahHarga')->sum('jumlahHarga');
        $outcome = Pengeluaran::whereMonth('created_at', '=', Carbon::today()->month)->get('jumlahHarga')->sum('jumlahHarga');
        $gaji = Gaji::whereMonth('created_at', '=', Carbon::today()->month)->get('gaji')->sum('gaji');
        $pembayaran = Pembayaran::whereMonth('created_at', '=', Carbon::today()->month)->get('total')->sum('total');
        $total = (($income + $pembayaran) - ($outcome + $gaji));
        $status = 0;
        if($status < $total){
            $status = "Untung "; 
        }elseif($status > $total){
            $status = "Rugi"; 
        }else{
            $status = "Tetap";
        }
        $value = [
            'totalPemasukkan' => $income,
            'totalPengeluaran' => $outcome,
            'totalGaji' => $gaji,
            'totalPembayaran' => $pembayaran,
            'nama' => 'Laba Rugi Pada Bulan ke '. $bulan. ' Tahun '. $tahun,
            'total' => $total,
            'status' => $status,
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ];
        Labarugi::create($value);
        return redirect(route('labaRugi.index'));

    }

    public function updateThisMonth(Request $request, $id)
    {
        $data = Labarugi::findOrFail($id);
        $data->delete($id);
        
        $dump = $request->all();

        $bulan = Carbon::today()->month;
        $tahun = Carbon::today()->year;
        $income = Pemasukkan::whereMonth('created_at', '=', Carbon::today()->month)->get('jumlahHarga')->sum('jumlahHarga');
        $outcome = Pengeluaran::whereMonth('created_at', '=', Carbon::today()->month)->get('jumlahHarga')->sum('jumlahHarga');
        $gaji = Gaji::whereMonth('created_at', '=', Carbon::today()->month)->get('gaji')->sum('gaji');
        $pembayaran = Pembayaran::whereMonth('created_at', '=', Carbon::today()->month)->get('total')->sum('total');
        $total = (($income + $pembayaran) - ($outcome + $gaji));
        $status = 0;
        if($status < $total){
            $status = "Untung "; 
        }elseif($status > $total){
            $status = "Rugi"; 
        }else{
            $status = "Tetap";
        }
        $value = [
            'totalPemasukkan' => $income,
            'totalPengeluaran' => $outcome,
            'totalGaji' => $gaji,
            'totalPembayaran' => $pembayaran,
            'nama' => 'Laba Rugi Pada Bulan ke '. $bulan. ' Tahun '. $tahun,
            'total' => $total,
            'status' => $status,
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ];
        Labarugi::create($value);
        return redirect(route('labaRugi.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Labarugi::findOrFail($id);
        $getIncome = Pemasukkan::whereMonth('created_at', $data->created_at->format('m'))->get();
        $getPembayaran = Pembayaran::whereMonth('created_at', $data->created_at->format('m'))->get();
        $getOutcome = Pengeluaran::whereMonth('created_at', $data->created_at->format('m'))->get();
        $getGaji = Gaji::whereMonth('created_at', $data->created_at->format('m'))->get();

        return view('admin.keuangan.labarugi.show', compact('getIncome', 'getOutcome', 'getGaji', 'getPembayaran', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

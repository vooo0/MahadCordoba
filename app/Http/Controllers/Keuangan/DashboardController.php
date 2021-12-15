<?php

namespace App\Http\Controllers\Keuangan;

use App\Gaji;
use App\Http\Controllers\Controller;
use App\Labarugi;
use App\Pemasukkan;
use App\Pembayaran;
use App\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function dashboard()
    {
        $getPemasukkan = Pemasukkan::all();
        $getPengeluaran = Pengeluaran::all();
        $getPembayaran = Pembayaran::all();
        $getGaji = Gaji::all();
        $labaRugi = LabaRugi::all();
        
        $getLabarugi = Labarugi::selectRaw('year(created_at) tahun, monthname(created_at) bulan, sum(total) data')
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'desc')
        ->get();

        // dd($getLabarugi);
        
        $n=0;
        $data = [];
    foreach($getLabarugi as $key => $gp) {

        $data['labaRugi'][] = $getLabarugi[$n]->data;
        $data['bulan'][] = $getLabarugi[$n]->bulan;
        $data['tahun'][] = $getLabarugi[$n]->tahun;
        $n++;
        }
        // dd($data);
        $data['chart_data'] = json_encode($data);
        
        return view('admin.keuangan.dashboard', 
        compact('getPembayaran', 'getPemasukkan', 'getGaji', 'getLabarugi', 'getPengeluaran', 'data', 'labaRugi'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

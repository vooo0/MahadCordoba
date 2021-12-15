<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Pendaftaran;
use App\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getSiswa = Siswa::all();
        $getPendaftaran = Pendaftaran::all();
        $data = Pembayaran::all();
        return view('admin.keuangan.pembayaran.index', compact('data', 'getSiswa', 'getPendaftaran'));
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
        // dd($request->all());
        $data = $request->all();
        Pembayaran::create($data);
        return redirect(route('pembayaranKeuangan.index'));
    }

    public function pdf(Request $request)
    {
        $data['dateStart'] = $request->dateStart;
        $data['dateEnd'] = $request->dateEnd;
        $data['thisMonth'] = $request->dateEnd;
        $data['thisYear'] = $request->dateEnd;
        $data['getPembayaran'] = Pembayaran::whereBetween('created_at', [$data['dateStart'], $data['dateEnd']])->get();
        // dd($data);
        return view('admin.keuangan.pembayaran.pdf', compact('data'));
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

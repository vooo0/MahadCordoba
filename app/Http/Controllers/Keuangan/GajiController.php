<?php

namespace App\Http\Controllers\Keuangan;

use App\Admin;
use App\Gaji;
use App\Guru;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Pemasukkan;
use App\Pengeluaran;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gaji::all();
        $getGuru = Guru::all();
        $getAdmin = Admin::all();
        return view('admin.keuangan.gaji.index', compact('data', 'getGuru', 'getAdmin'));
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
        $data = $request->all();
        Gaji::create($data);
        return redirect(route('gaji.index'));
    }

    public function pdf(Request $request)
    {
        $data['dateStart'] = $request->dateStart;
        $data['dateEnd'] = $request->dateEnd;
        $data['thisMonth'] = $request->dateEnd;
        $data['thisYear'] = $request->dateEnd;
        $data['getGaji'] = Gaji::whereBetween('created_at', [$data['dateStart'], $data['dateEnd']])->get();
        // dd($data);
        return view('admin.keuangan.gaji.pdf', compact('data'));
    }

    public function gajiGuru(Request $request)
    {
        $data = $request->all();
        $data['gaji'] = $request->kehadiran * 15000;
        // dd($data);
        Gaji::create($data);
        return redirect(route('gajiGuru.edit', $request->guru_id));
    }
    
    public function gajiAdmin(Request $request)
    {
        $data = $request->all();
        $data['gaji'] = $request->kehadiran * 15000;
        // dd($data);
        Gaji::create($data);
        return redirect(route('gajiAdmin.show', $request->admin_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Admin::findOrFail($id);
        $getGaji = Gaji::where('admin_id', $id)->where('guru_id', '=', NULL)->get();
        return view('admin.keuangan.gaji.show', compact('data', 'getGaji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guru::findOrFail($id);
        $mpGuru = Kelas::where('guru_id', $id)->where('siswa_id', '=', NULL)->get();
        $getGaji = Gaji::where('guru_id', $id)->where('admin_id', '=', NULL)->get();
        // dd($mpGuru);
        $n=0;
        $getSiswa = array();
        foreach ($mpGuru as $mpg){
            $getSiswa[$n] = $mpg->where('siswa_id', '!=', NULL)->where('matapelajaran_id', $mpg->matapelajaran_id)->count();
            $n++;
        }
        return view('admin.keuangan.gaji.edit', compact('data', 'mpGuru', 'getSiswa', 'getGaji'));
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
        $data = Gaji::findOrFail($id);
        $data->update($request->all());
        return redirect(route('gaji.index'));
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Gaji::findOrFail($id);
        $data->delete($id);
        return redirect(route('gaji.index'));
    }
}

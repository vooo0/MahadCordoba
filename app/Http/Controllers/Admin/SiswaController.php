<?php

namespace App\Http\Controllers\Admin;

use App\Guru;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Matapelajaran;
use App\Siswa;
use App\Tahun;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['SuperAdmin','AdminUmum']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::all();
        return view('admin.umum.data.siswa.index', compact('data'));
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
        $mp = Matapelajaran::all();
        $th = Tahun::all();
        $data = Siswa::findOrFail($id);
        $getKelasGuru = Kelas::where('guru_id', '!=', NULL)->where('siswa_id', '=', NULL)->get();
        $mpSiswa = Kelas::where('siswa_id', $id)->get();
        $n=0;
        $getGuru = array();
        foreach ($mpSiswa as $mps){
            $getGuru[$n] = $mps->where('guru_id', '!=', NULL)->where('matapelajaran_id', $mps->matapelajaran_id)->count();
            $n++;
        }
        // dd($mpSiswa);
        return view('admin.umum.data.siswa.edit', compact('data', 'mp', 'mpSiswa', 'th', 'getGuru', 'getKelasGuru'));
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

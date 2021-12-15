<?php

namespace App\Http\Controllers\Guru;

use App\Guru;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Matapelajaran;
use App\Nilai;
use App\Siswa;
use App\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatapelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['getKelas'] = Kelas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', NULL)->get();
        
        $n=0;
        foreach ($data['getKelas'] as $getKelas){
            $data['getSiswa'] = Kelas::where('matapelajaran_id', $getKelas->matapelajaran_id)->where('siswa_id', '!=', NULL)->get();
            $n++;
        }
        $data['countSiswa'] = Kelas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', '!=', NULL)->count();
        // dd($data);
        return view('guru.matapelajaran.index', compact('data'));
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
        
        $data['getKelas'] = Kelas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', NULL)->where('id', $id)->first();
        $data['getSiswa'] = Kelas::where('siswa_id', '!=', NULL)->where('matapelajaran_id', $data['getKelas']->matapelajaran_id)->get();
        // dd($data['getSiswa']);
        return view('guru.matapelajaran.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getKelas = Kelas::findOrFail($id);
        $getSiswa = Siswa::where('id', $getKelas->siswa->id)->first();
        $getTugas = Tugas::where('siswa_id', $getKelas->siswa->id)
        ->where('guru_id', Auth::user()->guru->id)
        ->where('matapelajaran_id', $getKelas->matapelajaran_id)
        ->where('kelas_id', $getKelas->id)
        ->get();
        $getNilai = Nilai::where('siswa_id', $getKelas->siswa->id)
        ->where('guru_id', Auth::user()->guru->id)
        ->where('matapelajaran_id', $getKelas->matapelajaran_id)
        ->where('kelas_id', $getKelas->id)
        ->get();

        // dd($getSiswa, $getKelas, $getTugas, $getNilai);
        return view('guru.matapelajaran.edit', compact('getNilai', 'getKelas', 'getTugas', 'getSiswa'));
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

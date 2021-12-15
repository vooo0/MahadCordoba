<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Nilai;
use App\Siswa;
use App\Tugas;
use Carbon\Carbon;
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
        $data = Kelas::where('siswa_id', Auth::user()->siswa->id)->get();
        // dd($data);
        return view('siswa.matapelajaran.index', compact('data'));
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
        
    }

    public function tugasSiswa(Request $request)
    {
        $data['getKelasGuru']   = Kelas::findOrFail($request->kelas_id);
        $data['getSiswa']       = Siswa::findOrFail(Auth::user()->siswa->id);
        $data['getKelasSiswa']  = Kelas::where('siswa_id', $data['getSiswa']->id)->where('guru_id', $data['getKelasGuru']->guru_id)->where('matapelajaran_id', $data['getKelasGuru']->matapelajaran_id)->first();
        // $data['getKelas']       = Tugas::findOrFail($request->tugas_id);
        $data['value'] = array(
            'siswa_id'          => Auth::user()->siswa->id,
            'guru_id'           => $data['getKelasSiswa']->guru_id,
            'matapelajaran_id'  => $data['getKelasSiswa']->matapelajaran_id,
            'kelas_id'          => $data['getKelasSiswa']->id,
            'nama'              => $request->nama,
            'pdf'               => $request->pdf,
            'status'            => '0',
            'tanggal'           => Carbon::today()->format('d-m-Y'),
        );
        // dd($data);
        Tugas::create($data['value']);
        return redirect(route('matapelajaran.edit', $request->kelas_id));
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
        $data['getKelasGuru']   = Kelas::findOrFail($id);
        $data['getSiswa']       = Siswa::findOrFail(Auth::user()->siswa->id);
        $data['getTugasGuru']   = Tugas::where('matapelajaran_id', $data['getKelasGuru']->matapelajaran_id)->where('siswa_id', NULL)->get();
        $data['getKelasSiswa']  = Kelas::where('siswa_id', $data['getSiswa']->id)->where('guru_id', $data['getKelasGuru']->guru_id)->where('matapelajaran_id', $data['getKelasGuru']->matapelajaran_id)->first();
        $data['getTugasSiswa']  = Tugas::where('matapelajaran_id', $data['getKelasSiswa']->matapelajaran_id)->where('kelas_id', $data['getKelasSiswa']->id)->get();
        $data['getNilai']       = Nilai::where('kelas_id', $id)->get();
        // dd($data);
        return view('siswa.matapelajaran.edit', compact('data'));

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

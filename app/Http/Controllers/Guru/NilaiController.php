<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Nilai;
use App\Siswa;
use App\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['getKelasGuru'] = Kelas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', NULL )->get();
        $data['getKelasSiswa'] = Kelas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', '!=',NULL )->get();
        $n=0;
        foreach ($data['getKelasSiswa'] as $key => $gks) {
            $data['getNilai'][$n] = Nilai::where('guru_id', Auth::user()->guru->id)->where('kelas_id', $gks->id)->get();
            $n++;
        }
        // dd($data);
        return view('guru.nilai.index', compact('data'));
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
        $data['valueNilai'] = array(
            'siswa_id'          => $request->siswa_id,
            'guru_id'           => $request->guru_id,
            'matapelajaran_id'  => $request->matapelajaran_id,
            'kelas_id'          => $request->kelas_id,
            'tugas_id'          => $request->tugas_id,
            'nama'              => $request->nama,
            'status'            => '1',
            'nilai'             => $request->nilai,
            'tanggal'           => Carbon::today()->format('d-m-Y'),
        );
        $data['getTugasSiswa'] = Tugas::findOrFail($request->tugas_id);
        $data['valueTugasSiswa'] = array(
            'status'            => '1',
        );
        // dd($data);
        $data['getTugasSiswa']->update($data['valueTugasSiswa']);
        Nilai::create($data['valueNilai']);

        return redirect(route('matapelajaranGuru.edit', $request->kelas_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['getKelas'] = Kelas::findOrFail($id);
        $data['getNilai'] = Nilai::where('kelas_id', $id)->get();
        $data['today'] = Carbon::today()->format('d-m-Y');
        // dd($data);
        return view('guru.nilai.edit', compact('data'));
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
        $data['valueNilai'] = array(
            'siswa_id'          => $request->siswa_id,
            'guru_id'           => $request->guru_id,
            'matapelajaran_id'  => $request->matapelajaran_id,
            'kelas_id'          => $request->kelas_id,
            'tugas_id'          => $request->tugas_id,
            'nama'              => $request->nama,
            'status'            => '1',
            'nilai'             => $request->nilai,
            'tanggal'           => Carbon::today()->format('d-m-Y'),
        );
        $data['getNilai'] = Nilai::findOrFail($id);
        $data['getNilai']->update($data['valueNilai']);
        return redirect(route('matapelajaranGuru.edit', $request->kelas_id));
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

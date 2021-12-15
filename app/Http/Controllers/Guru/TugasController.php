<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Matapelajaran;
use App\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['getTugas'] = Tugas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', NULL)->get();
        $data['getKelas'] = Kelas::where('guru_id', Auth::user()->guru->id)->where('siswa_id', NULL)->get();
        $data['getMatapelajaran'] = Matapelajaran::all();
        return view('guru.tugas.index', compact('data'));
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
        $getMatapelajaran = Kelas::where('id', $request->kelas_id)->select('matapelajaran_id')->first();
        $data = $request->all();
        $data['guru_id'] = Auth::user()->guru->id;
        $data['tanggal'] = Carbon::today()->format('d-m-Y');
        $data['matapelajaran_id'] = $getMatapelajaran->matapelajaran_id;
        // dd($data);
        
        Tugas::create($data);
        return redirect(route('tugas.index'));

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
        // dd($request->all());
        $data['getTugas'] = Tugas::findOrFail($id); 
        $data['update'] = $request->all();
        $data['getTugas']->update($data['update']);
        return redirect()->route('tugas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tugas::findOrFail($id);
        $data->delete($id);

        return redirect(route('tugas.index'));
    }
}

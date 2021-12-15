<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
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
        //
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
        Kelas::create($data);
        return redirect(route('dataGuru.edit', $request->guru_id));
    }
    
    public function storeKelasSiswa(Request $request)
    {
        $data['getKelas'] = Kelas::findOrFail($request->kelas_id);
        $data['value'] = array(
            'siswa_id' => $request->siswa_id,
            'guru_id' => $data['getKelas']->guru_id,
            'matapelajaran_id' => $data['getKelas']->matapelajaran_id,
            'tahun_id' => $request->tahun_id,
            'status' => $request->status,
        );
        // dd($data);
        Kelas::create($data['value']);
        return redirect(route('dataSiswa.edit', $request->siswa_id));
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

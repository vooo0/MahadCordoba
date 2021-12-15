<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Pengumuman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pengumuman::where('guru_id', Auth::user()->guru->id)->get();
        return view('guru.pengumuman.index', compact('data'));
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
        $data['tanggal'] = Carbon::now()->format('d-m-Y');
        $data['guru_id'] = Auth::user()->guru->id;
        // dd($data);
        Pengumuman::create($data);
        return redirect(route('pengumuman.index'));
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
        $data = pengumuman::findOrFail($id);
        $value = $request->all();
        $value['tanggal'] = Carbon::now()->format('d-m-Y');
        $value['guru_id'] = Auth::user()->guru->id;
        // dd($value);
        $data->update($value);
        return redirect(route('pengumuman.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengumuman::findOrFail($id);
        $data->delete($id);
        return redirect(route('pengumuman.index'));
    }
}

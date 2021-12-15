<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::all();
        return view('admin.keuangan.pengeluaran.index', compact('data'));
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
        Pengeluaran::create($data);
        return redirect(route('pengeluaran.index'));
    }

    public function pdf(Request $request)
    {
        $data['dateStart'] = $request->dateStart;
        $data['dateEnd'] = $request->dateEnd;
        $data['thisMonth'] = $request->dateEnd;
        $data['thisYear'] = $request->dateEnd;
        $data['getPengeluaran'] = Pengeluaran::whereBetween('created_at', [$data['dateStart'], $data['dateEnd']])->get();
        // dd($data);
        return view('admin.keuangan.pengeluaran.pdf', compact('data'));
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
        $data = Pengeluaran::findOrFail($id);
        $data->update($request->all());
        return redirect(route('pengeluaran.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengeluaran::findOrFail($id);
        $data->delete($id);
        return redirect(route('pengeluaran.index'));
    }
}

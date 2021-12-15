<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Matapelajaran;
use Illuminate\Http\Request;

class MatapelajaranController extends Controller
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
        $data = Matapelajaran::all();
        return view('admin.umum.data.matapelajaran.index', compact('data'));
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
        Matapelajaran::create($data);
        return redirect(route('dataMatapelajaran.index'));
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
        $data = Matapelajaran::findOrFail($id);
        $data->update($request->all());
        return redirect(route('dataMatapelajaran.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Matapelajaran::findOrFail($id);
        $data->delete($id);
        return redirect(route('dataMatapelajaran.index'));
    }
}

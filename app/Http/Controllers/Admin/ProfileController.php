<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Guru;
use App\Http\Controllers\Controller;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAdmin = Admin::all();
        $getGuru = Guru::all();
        $getSiswa = Siswa::all();
        $getUser = User::all();

        $ga = json_decode($getAdmin);
        $gg = json_decode($getGuru);
        $gs = json_decode($getSiswa);
        $gu = json_decode($getUser);

        // dd($ga, $gs, $gg);

        $random = array_merge($ga, $gs, $gg);
        $rand = array_rand($gu, 5);
        for ($i=0; $i < 5 ; $i++) { 
            $getRandom[$i] = $gu[$rand[$i]];
        }
        // dd($random, $rand);

        return view('admin.umum.profile',compact('getRandom'));
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

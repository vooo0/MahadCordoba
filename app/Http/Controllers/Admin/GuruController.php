<?php

namespace App\Http\Controllers\Admin;

use App\Guru;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Matapelajaran;
use App\Tahun;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
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
        $data = Guru::all();
        return view('admin.umum.data.guru.index', compact('data'));
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
        $getUser = [
            'level' => 'guru', 
            'name' => $request->nama, 
            'email' => $request->email, 
            'password' => Hash::make('passowrd'), 
        ];
        $data = $request->all();
        $user = User::create($getUser);
        $data['user_id'] = $user->id;
        Guru::create($data);
        return redirect(route('dataGuru.index'));
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
        $data = Guru::findOrFail($id);
        $mpGuru = Kelas::where('guru_id', $id)->where('siswa_id', '=', NULL)->get();
        $n=0;
        $getSiswa = array();
        foreach ($mpGuru as $mpg){
            $getSiswa[$n] = $mpg->where('siswa_id', '!=', NULL)->where('matapelajaran_id', $mpg->matapelajaran_id)->count();
            $n++;
        }
        return view('admin.umum.data.guru.edit', compact('data', 'mp', 'mpGuru', 'th', 'getSiswa'));
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
        $data = Guru::findOrFail($id);
        $data->update($request->all());

        return redirect(route('dataGuru.edit', $id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Guru::findOrFail($id);
        $data->delete();
        return redirect(route('dataGuru.index'));
    }
}

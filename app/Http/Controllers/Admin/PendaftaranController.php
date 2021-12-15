<?php

namespace App\Http\Controllers\Admin;

use App\Bulan;
use App\Http\Controllers\Controller;
use App\Pendaftaran;
use App\Siswa;
use App\Tahun;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PendaftaranController extends Controller
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
        $data['pendaftaran'] = Pendaftaran::all();
        $data['getMonth'] = Bulan::select('nama')->get();
        $data['getYear'] = Tahun::select('tahun')->get();

        return view('admin.umum.data.pendaftaran.index', compact('data'));
    }
    
    public function pdf(Request $request)
    {
        $data['dateStart'] = $request->dateStart;
        $data['dateEnd'] = $request->dateEnd;
        $data['thisMonth'] = Carbon::today()->format('m');
        $data['thisYear'] = Carbon::today()->format('Y');
        $data['getPendaftaran'] = Pendaftaran::whereBetween('created_at', [$data['dateStart'], $data['dateEnd']])->get();
        // dd($data);
        return view('admin.umum.data.pendaftaran.pdf', compact('data'));
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
        Pendaftaran::create($data);
        return redirect(route('pendaftaran.index'));
    }
    
    public function storeSiswa(Request $request)
    {
        $data = $request->all();
        Pendaftaran::create($data);
        return redirect(route('login'));
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
        $data = Pendaftaran::findOrFail($id);
        return view('admin.umum.data.pendaftaran.edit', compact('data'));
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
        $value = $request->all();
        $data = Pendaftaran::findOrFail($id);
        if($value['status'] == '2'){
            $getUser = [
                'level' => 'siswa',
                'name' => $data->nama,
                'email' => $data->email,
                'password' => Hash::make('password'),
            ];
            $createUser = User::create($getUser);
            
            $getData = [
                'user_id' => $createUser->id,
                'pelamar_id' => $data->id,
                'nama' => $data->nama,
                'telephone' => $data->telephone,
                'email' => $data->email,
                'tanggalLahir' => $data->tanggalLahir,
                'jenisKelamin' => $data->jenisKelamin,
                'statusKtp' => $data->statusKtp,
                'pendidikan' => $data->pendidikan,
                'alamatAsli' => $data->alamatAsli,
                'alamatSekarang' => $data->alamatSekarang,
                'foto' => NULL,
                'status' => $data->status,
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
            ];
            Siswa::create($getData);
            $data->update($value);
            return redirect(route('pendaftaran.index'));
        }else{
            $data->update($value);
            return redirect(route('pendaftaran.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pendaftaran::findOrFail($id);
        $data->delete($id);
        return redirect(route('pendaftaran.index'));
    }
}

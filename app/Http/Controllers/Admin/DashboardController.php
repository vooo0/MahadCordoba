<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Bulan;
use App\Guru;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Pendaftaran;
use App\Siswa;
use App\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['AdminUmum']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    
    public function dashboard()
    {
        $getAdmin = Admin::all();
        $getGuru = Guru::all();
        $getSiswa = Siswa::all();
        $getKelas = Kelas::all();
        $pendaftaran = Pendaftaran::all();

        $getPendaftaran = Pendaftaran::selectRaw('year(created_at) tahun, monthname(created_at) bulan, count(*) data')
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'desc')
        ->get();
        
        $n=0;
        $data = [];
    foreach($getPendaftaran as $key => $gp) {

        $data['pendaftaran'][] = $getPendaftaran[$n]->data;
        $data['bulan'][] = $getPendaftaran[$n]->bulan;
        $data['tahun'][] = $getPendaftaran[$n]->tahun;
        $n++;
        }
        // dd($data);
        $data['chart_data'] = json_encode($data);
        
        return view('admin.umum.data.dashboard', 
        compact('getAdmin', 'getPendaftaran', 'getGuru', 'getSiswa', 'getKelas', 'data', 'pendaftaran'
        ));
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

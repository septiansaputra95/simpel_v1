<?php

namespace App\Http\Controllers;

use App\Models\Antrol;
use Illuminate\Http\Request;
use App\Repositories\RepoAntrol;

class AntrolController extends Controller
{
    protected $repoAntrol;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // $this->middleware('auth:dbpass');
        // IKI inisialisasi CLASS histori Pasien di folder repositories
        $this->repoAntrol   = new RepoAntrol;
    }

    public function index()
    {
        //
        return view('antrol/index');
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            $dataRawatJalan = $this->repoAntrol->getDataRawatJalan($request);
            // dd($dataRawatJalan);
            $no = 1;
            foreach($dataRawatJalan as $val) {

                $query[] = [
                    'no' => $no++,
                    'kodebooking' => $val->kodebooking,
                    'mrn' => $val->no_mrn,
                    'nama_pasien' => $val->nama_pasien,
                    'dokter' => $val->nama_dokter,
                    'status' => $val->status,
                    'no_kartu' => $val->nokartu,
                    'task_1' => $val->waktu_task1,
                    'task_2' => $val->waktu_task2,
                    'task_3' => $val->waktu_task3,
                    'task_4' => $val->waktu_task4,
                    'task_5' => $val->waktu_task5,
                    'task_6' => $val->waktu_task6,
                    'task_7' => $val->waktu_task7,
                    'no_sep' => $val->nosep,
                    'aksi' => '<a class="btn btn-outline-success">Aksi</a>'
                ];
            }

            $result = isset($query) ? ['data' => $query] : ['data' => 0];
            return response()->json($result);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrol $antrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrol $antrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antrol $antrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrol $antrol)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmasiKonsumsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('farmasikonsumsi.index');
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {
            $dataRawatJalan = $this->repoRawatJalan->getDataRawatJalan($request);
            //dd($dataRawatJalan);
            $no = 1;
            foreach($dataRawatJalan as $val) {

                $query[] = [
                    'no' => $no++,
                    'no_reg' => $val->no_registrasi,
                    'no_rm' => $val->no_rekamedis,
                    'no_kartu' => $val->no_kartu,
                    'tanggal_lahir' => tanggalFormat($val->tanggal_lahir),
                    'nama_pasien' => $val->nama_pasien,
                    'tanggal_registrasi' => tanggalFormat($val->tanggal_registrasi),
                    'jaminan' => $val->jaminan,
                    'poli_tujuan' => $val->nama_poli,
                    'alamat_pasien' => $val->alamat_pasien,
                    'no_telp' => $val->no_telp,
                    'nama_dokter' => $val->nama_dokter,
                    'no_sep' => $val->no_sep,
                    'aksi' => $this->setButton($val->no_registrasi)
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

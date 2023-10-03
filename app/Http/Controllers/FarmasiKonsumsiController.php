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
                    'data_id' => $val->data_id,
                    'nama' => $val->nama,
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

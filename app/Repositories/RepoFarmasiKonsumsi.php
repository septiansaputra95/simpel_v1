<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RepoFarmasiKonsumsi
{
    public function getDataKonsumsi($request)
    {
        //dd($request->tanggal_registrasi);
        return DB::table('pharmacy_consumption_header as ph')
                ->select('ph.data_id as data_id',
                    'ph.nama_petugas as nama',
                    'ph.tanggal as tanggal'
                    )
                ->join('pharmacy_consumption as p', 'ph.data_id', 'p.data_id')
                ->get();
    }

    public function model(array $row)
    {
        return new PharmacyConsumption([
            'Document No' => $row[0],
            'Consumed Date' => $row[1],
            'Department' => $row[2],
            'Store Name' => $row[3],
            'MRN' => $row[4],
            'Visit No' => $row[5],
            'Patient Name' => $row[6],
            'Gender' => $row[7],
            'Age' => $row[8],
        ]);
    }

    public function simpanFarmasiKonsumsiHeader($request, $dataid)
    {
        return DB::table('pharmacy_consumption_header')->insert([
            'data_id'             => $dataid,
            'nama_petugas'        => $request->nama_petugas,
            'tanggal'             => date('Y-m-d h:s:i')
        ]);
    }

}
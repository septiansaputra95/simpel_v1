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
}
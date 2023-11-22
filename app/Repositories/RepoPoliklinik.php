<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RepoPoliklinik
{
    public function getDataDokter()
    {
        //dd($request->tanggal_registrasi);
        return DB::table('dokter')
                ->where('department', '=', 'Dokter Spesialis')
                ->get();
    }

}
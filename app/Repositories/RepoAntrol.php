<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RepoAntrol
{
    public function getDataRawatJalan($request)
    {
        //dd($request->tanggal_registrasi);
        return DB::connection('pgsql_hinai')->table('bpjs_task_list')
                                            ->where('tanggal', $request->tanggal_registrasi)
                                            ->get();
        
    }

    public function getRawatJalan($noreg)
    {
        return DB::table('register as r')
        ->select(
            'r.regno as no_reg',
            'p.medrec as no_rm',
            'p.firstname as nama_pasien',
            'p.bod as tgl_lahir',
            'p.noiden as nik',
            'p.askesno as no_kartu',
            'p.address as alamat_pasien',
            'p.phone as no_telp',
            'p.kdsex as jenis_kelamin',
            'd.nmdoc as nama_dokter', 
            'r.regdate as tgl_reg',
            'r.kdpoli as kode_poli',
            'r.kddoc as kode_dokter',
            'r.kdjaminan as asuransi', 
            'r.validuser'
        )
        ->leftJoin('rawatjalan as rj', 'r.medrec','rj.medrec')
        ->join('masterps as p', 'r.medrec', 'p.medrec')
        ->leftJoin('ftdokter as d', 'r.kddoc', 'd.kddoc')
        ->where('r.regno', '=', $noreg)->first();
    }

}
<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RepoFarmasiKonsumsi
{
    public function getDataKonsumsi($request)
    {
        //dd($request->tanggal_registrasi);
        return DB::table('register as r')
                ->select('r.regno as no_registrasi',
                    'r.medrec as no_rekamedis',
                    'r.regdate as tanggal_registrasi',
                    'r.nosep as no_sep',
                    'a.asuransi_nama as jaminan',
                    'ps.firstname as nama_pasien',
                    'ps.address as alamat_pasien',
                    'ps.bod as tanggal_lahir',
                    'ps.askesno as no_kartu',
                    'ps.phone as no_telp',
                    'pl.nmpoli as nama_poli',
                    'd.nmdoc as nama_dokter'
                    )
                ->join('masterps as ps', 'r.medrec', 'ps.medrec')
                ->leftjoin('rawatjalan as rj', 'r.regno', 'rj.registrasi_no')
                ->leftjoin('asuransi as a', 'rj.asuransi_id','a.asuransi_id')
                ->leftjoin('ftdokter as d', 'r.kddoc','d.kddoc')
                ->join('politpp as pl', 'r.kdpoli','pl.kdpoli')
                ->whereDate('r.regdate', $request->tanggal_registrasi)
                ->where('r.kdpoli', '!=', 04)
                ->get();
    }
}
<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RepoPermintaan
{
    public function generate($bulan, $tahun)
    {
        
        $data = DB::table('masterunit')
                ->orderby('unit_id')
                ->get();

        //dd(count($data));
        $dataunitid     = [];
        $dataunitnama   = [];
        $dataharga      = [];
        $index          = 1;

        foreach ($data as $item){
            $harga = 0 ;
            $dataunitid[$index]     = $item->unit_id;
            $dataunitnama[$index]   = $item->unit_nama;

            $datapermintaan = DB::table('permintaan_detail')
                    ->join('permintaan_header', 'permintaan_header.permintaan_header_id', '=', 'permintaan_detail.permintaan_header_id')
                    ->where('permintaan_header.unit_id', '=', $item->unit_id)
                    ->whereMonth('permintaan_header.permintaan_header_tgl', $bulan)
                    ->whereYear('permintaan_header.permintaan_header_tgl', $tahun)
                    ->get();
            foreach($datapermintaan as $itempermintaan){
                $harga = $harga + $itempermintaan->permintaan_detail_harga;
            }
            $dataharga[$index] = $harga;
            $index++;
        }
        // dd($dataunitid, $dataunitnama, $dataharga);
        // return $dataunitid;
        // return $dataunitnama;
        // return $dataharga;

        return [$dataunitid, $dataunitnama, $dataharga, $data];
    }
}
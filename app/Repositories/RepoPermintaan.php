<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RepoPermintaan
{
    public function generate()
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        // Jika bulan dan tahun tidak ada yang dikirimkan dari menu atau form
        if ($bulan === null && $tahun === null) {
            // Set nilai default bulan dan tahun menjadi bulan dan tahun sekarang
            $bulanSekarang = Carbon::now()->format('m'); // Mendapatkan nilai bulan sekarang (format: 01, 02, ..., 12)
            $tahunSekarang = Carbon::now()->format('Y'); // Mendapatkan nilai tahun sekarang (format: 2023, 2024, dsb.)
            //dd($bulanSekarang);
        } else {
            // Jika bulan dan tahun dikirimkan dari form, gunakan nilai dari form
            $bulanSekarang = $request->input('bulan');
            $tahunSekarang = $request->input('tahun');
            //dd($bulanSekarang, $tahunSekarang);
        }
        
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
                    ->whereMonth('permintaan_header.permintaan_header_tgl', $bulanSekarang)
                    ->whereYear('permintaan_header.permintaan_header_tgl', $tahunSekarang)
                    ->get();
            foreach($datapermintaan as $itempermintaan){
                $harga = $harga + $itempermintaan->permintaan_detail_harga;
            }
            $dataharga[$index] = $harga;
            $index++;
        }
    }
}
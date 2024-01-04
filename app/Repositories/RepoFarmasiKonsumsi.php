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
                    'ph.tanggal as tanggal',
                    'ph.konsumsi_tanggal as konsumsi'
                    )
                //->whereBetween('ph.konsumsi_tanggal', [$request->tanggal_dari, $request->tanggal_sampai])
                ->orderby('ph.tanggal', 'DESC')
                ->get();
    }

    // GENERATE RESEP DAN SUB RESEP
    public function getResep($request)
    {
        $gudang = ['FARMASI EXECUTIVE', 'FARMASI REGULER'];
        $jenis = ['OP', 'IP'];
        for($i=0; $i < count($gudang); $i++)
        {
            for($j=0; $j <count($jenis); $j++)
            {
            $data = DB::table('pharmacy_consumption as pc')
                ->select('document_no', DB::raw('COUNT(*) as count'))
                ->where('data_id', $request->data_id)
                ->where('storename', $gudang[$i])
                ->where('visit_type', $jenis[$j])
                ->groupBy('document_no') // Tambahkan groupBy di sini
                ->get();
            
            $hasil[] = $data->count();
            }
        }
        $formatResult = "FARMASI EXECUTIVE OP = {$hasil[0]} | ";
        $formatResult .= "FARMASI EXECUTIVE IP = {$hasil[1]} | ";
        $formatResult .= "FARMASI REGULER OP = {$hasil[2]} | ";
        $formatResult .= "FARMASI REGULER IP = {$hasil[3]} | ";
        //$formatResult = $hasil;
        return $formatResult;  
    }

    public function getSubResep($request)
    {
        $gudang = ['FARMASI EXECUTIVE', 'FARMASI REGULER'];
        $jenis = ['OP', 'IP'];
        for($i=0; $i < count($gudang); $i++)
        {
            for($j=0; $j <count($jenis); $j++)
            {
            $data = DB::table('pharmacy_consumption as pc')
                ->select('document_no')
                ->where('data_id', $request->data_id)
                ->where('storename', $gudang[$i])
                ->where('visit_type', $jenis[$j])
                // ->groupBy('document_no') // Tambahkan groupBy di sini
                ->get();
            
            $hasil[] = $data->count();
            }
        }
        $formatResult = "FARMASI EXECUTIVE OP = {$hasil[0]} | ";
        $formatResult .= "FARMASI EXECUTIVE IP = {$hasil[1]} | ";
        $formatResult .= "FARMASI REGULER OP = {$hasil[2]} | ";
        $formatResult .= "FARMASI REGULER IP = {$hasil[3]} | ";
        //$formatResult = $hasil;
        return $formatResult;  
    }

    // GENERATE BIAYA EKSE DAN JKN
    public function getBiayaObatEkse($request)
    {
        $gudangkecil = 'BPJS';
        $gudangbesar = 'FARMASI REGULER';
        
        $totalCost = DB::table('pharmacy_consumption as pc')
            //->select(DB::raw('cost_value'))
            ->where('data_id', $request->data_id)
            ->whereNotIn('storename', [$gudangkecil, $gudangbesar])
            //->first(); // Menggunakan first() karena kita hanya mengharapkan satu hasil
            ->get();
        $hasil = $totalCost->count();
        
        $formatResult = "{$hasil}";
        //$formatResult = $hasil;
        return $formatResult;  
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
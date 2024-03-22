<?php

namespace App\Http\Controllers;
use App\Models\SuhuRuanganModel;
use Illuminate\Http\Request;

class SuhuRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $suhuRuanganModel;

    public function __construct(SuhuRuanganModel $suhuRuanganModel)
    {
        $this->suhuRuanganModel = $suhuRuanganModel;
    }

    public function index()
    {
        //
        $masterUnitData = $this->suhuRuanganModel->getAllMasterUnitData();
        return view('suhuruangan.index', ['masterUnitData' => $masterUnitData]);
    }

    public function chart(Request $request)
    {

        $unitId = $request->input('unit');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        // $unitId = 1;
        // $bulan = 1;
        // $tahun = 2024;

        //dd($unitId, $bulan, $tahun);

        $data = $this->suhuRuanganModel->getDataByUnitBulanTahun($unitId, $bulan, $tahun);

        // Inisialisasi array untuk menyimpan labels dan data
        $labels = [];
        $dataValue = [];

        foreach($data as $item)
        {
            $labels[] = $item->tanggal.' '.$item->jam;
            $dataValue[] = $item->suhuruangan;
        }

        $chartData = [
            'labels'    => $labels,
            'data'      => $dataValue
        ];
        //dd($chartData);

         // Lakukan sesuatu dengan data, misalnya kirimkan sebagai respons JSON
        return response()->json($chartData);
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

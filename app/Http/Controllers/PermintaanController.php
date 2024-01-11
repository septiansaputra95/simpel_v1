<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari database
        $data = DB::table('permintaan_header')
                ->leftjoin('pengguna', 'pengguna.pengguna_id', '=', 'permintaan_header.pengguna_id')
                ->leftjoin('masterunit', 'masterunit.unit_id', '=', 'permintaan_header.unit_id')
                ->leftjoin('supplier', 'supplier.supplier_id', '=', 'permintaan_header.supplier_id')
                ->orderBy('permintaan_header_id','desc')
                ->get();
        
        // Memanggil view dengan memasukan variabel data
        return view('permintaan.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = DB::table('masterbarang')
                ->orderBy('barang_nama','asc')
                ->get();

        $dataunit   = DB::table('masterunit')
                    ->orderBy('unit_id','asc')
                    ->get();

        return view('permintaan.create', ['data' => $data, 'dataunit' => $dataunit]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userid = '033123';
        // Mengambil data dari form tambah
        $request->validate([
            'id'            => 'required',
            'supplier'      => 'required',
            'keterangan'    => 'required',
            'namakaryawan'  => 'required',
            'nomor'         => 'required',
            'unitbagian'    => 'required'
        ]);
        //dd($request);
        // Mencari data unit berdasarkan pengguna id
        // Ini belum dibutuhkan
        $data = DB::table('pengguna')
                ->where('pengguna_id', '=', $userid)
                ->get(); 
        
        // Memasukan data unit id untuk masuk ke variabel $unit_id
        foreach($data as $item){
            $unit_id = $item->unit_id;
        }
        
        $date = date('Y-m-d');
        //dd($date);
        $count = $request->nomor;
        // dd($count);

        // Memasukan data ke dalam database tabel header
         DB::table('permintaan_header')->insert([
            'permintaan_header_id'          => $request->id,
            'permintaan_header_tgl'         => $date,
            'pengguna_id'                   => $userid,
            'unit_id'                       => $request->unitbagian,
            'supplier_id'                   => $request->supplier,
            'permintaan_header_keterangan'  => $request->keterangan,
            'karyawan'                      => $request->namakaryawan
        ]);
        //return redirect('permintaan')->with('sukses', 'Data User Berhasil ditambah!');
        // Perulangan untuk masuk ke tabel permintaan detail
        for($i = 0; $i < $count; $i++){
            $request->validate([
                'barang_'.$i        => 'required',
                'jumlah_'.$i        => 'nullable',
                'hargasatuan_'.$i   => 'nullable'
            ]);
            
            //dd($request);
            $detail_id = $request->id.'_'.rand(1,10000);
            // memasukan data ke dalam tabel permintaan detail
            DB::table('permintaan_detail')->insert([
               'permintaan_detail_id'           => $detail_id,
               'permintaan_header_id'           => $request->id,
               'barang_id'                      => $request->{'barang_'.$i},
               'permintaan_detail_jumlah'       => $request->{'jumlah_'.$i},
               'permintaan_detail_harga'        => $request->{'hargasatuan_'.$i}
            ]);
            
        }
        // Mengambil Data untuk kemudian di cetak
        $data = DB::table('permintaan_header')
                ->leftjoin('permintaan_detail', 'permintaan_detail.permintaan_header_id', '=', 'permintaan_header.permintaan_header_id')
                ->leftjoin('masterbarang', 'masterbarang.barang_id', '=', 'permintaan_detail.barang_id')
                ->leftjoin('masterunit', 'masterunit.unit_id', '=', 'permintaan_header.unit_id')
                ->where('permintaan_header.permintaan_header_id', '=', $request->id)
                ->get();
        return view('permintaan.print', ['data' => $data]);
        //return redirect('/permintaan');
        //return redirect('permintaan')->with('sukses', 'Data User Berhasil ditambah!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        //$permintaan_id = date('Ymd').''.rand(2,1000);
        $userid = '033123';
        // Mengambil data dari form tambah
        $request->validate([
            'id'            => 'required',
            'supplier'      => 'required',
            'keterangan'    => 'required',
            'namakaryawan'  => 'required',
            'unitbagian'    => 'required'
        ]);
        $databarang = [];
        $datajumlah = [];
        for($i = 1; $i <= 10; $i++){
            
            $databarang[] = $request->input('barang_'.$i);
            $datajumlah[] = $request->input('jumlah_'.$i);
            
        }
     
        $masterbarang = DB::table('masterbarang')
                        ->orderBy('barang_nama','asc')
                        ->get(); 
        $dataunit   = DB::table('masterunit')
                    ->where('unit_id', '=', $request->unitbagian)
                    ->orderBy('unit_id','asc')
                    ->get();

        // Memanggil view dengan memasukan variabel data
        return view('permintaan.show', ['request' => $request,
        'databarang'    => $databarang, 
        'datajumlah'    => $datajumlah, 
        'masterbarang'  => $masterbarang,
        'dataunit'      => $dataunit]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function print($id)
    {
        $data = DB::table('permintaan_header')
                ->leftjoin('permintaan_detail', 'permintaan_detail.permintaan_header_id', '=', 'permintaan_header.permintaan_header_id')
                ->leftjoin('masterbarang', 'masterbarang.barang_id', '=', 'permintaan_detail.barang_id')
                ->leftjoin('masterunit', 'masterunit.unit_id', '=', 'permintaan_header.unit_id')
                ->where('permintaan_header.permintaan_header_id', '=', $id)
                ->get();
        return view('permintaan.print', ['data' => $data]);
    }

    public function edit(Permintaan $permintaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permintaan $permintaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permintaan $permintaan)
    {
        //
    }

    public function laporan(Request $request, $bulan = null, $tahun = null)
    {
        //
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
        //dd($dataunitid, $dataunitnama, $dataharga);
        return view('permintaan.laporan', [
            'data'          => $data,
            'dataunitid'    => $dataunitid,
            'dataunitnama'  => $dataunitnama,
            'dataharga'     => $dataharga,
            'bulan'         => $bulanSekarang,
            'tahun'         => $tahunSekarang
        ]);
    }

    public function detail($id, $bulan, $tahun)
    {
        //
        //dd($id, $bulan, $tahun);
        $dataunit = DB::table('masterunit')
                    ->where('unit_id', '=', $id)
                    ->get();

        foreach($dataunit as $item){
            $unitnama = $item->unit_nama;
        }
        $datapermintaan = DB::table('permintaan_detail')
                        ->join('permintaan_header', 'permintaan_header.permintaan_header_id', '=', 'permintaan_detail.permintaan_header_id')
                        ->join('masterbarang', 'masterbarang.barang_id', '=', 'permintaan_detail.barang_id')
                        ->where('permintaan_header.unit_id', '=', $id)
                        ->whereMonth('permintaan_header.permintaan_header_tgl', $bulan)
                        ->whereYear('permintaan_header.permintaan_header_tgl', $tahun)
                        ->get();

        return view('permintaan.detail', [
            'datapermintaan'   => $datapermintaan,
            'bulan'            => $bulan,
            'tahun'            => $tahun,
            'unitnama'         => $unitnama

        ]);
    }
}

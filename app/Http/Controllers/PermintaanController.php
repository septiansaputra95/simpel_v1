<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Repositories\RepoPermintaan;
use App\Exports\PermintaanExport;
use Maatwebsite\Excel\Facades\Excel;


class PermintaanController extends Controller
{
    protected $repoPermintaan;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // $this->middleware('auth:dbpass');
        // IKI inisialisasi CLASS histori Pasien di folder repositories
        $this->repoPermintaan   = new RepoPermintaan;
    }
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
    try {
        $userid = '033123';

        // Validasi data utama
        $request->validate([
            'id'            => 'required',
            'supplier'      => 'required',
            'keterangan'    => 'required',
            'namakaryawan'  => 'required',
            'nomor'         => 'required|integer',
            'unitbagian'    => 'required'
        ]);

        // Ambil data pengguna berdasarkan ID
        $user = DB::table('pengguna')->where('pengguna_id', $userid)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $unit_id = $user->unit_id;
        $date = now();
        $count = $request->nomor;

        // Simpan ke tabel header
        DB::table('permintaan_header')->insert([
            'permintaan_header_id'          => $request->id,
            'permintaan_header_tgl'         => $date,
            'pengguna_id'                   => $userid,
            'unit_id'                       => $request->unitbagian,
            'supplier_id'                   => $request->supplier,
            'permintaan_header_keterangan'  => $request->keterangan,
            'karyawan'                      => $request->namakaryawan
        ]);

        // Simpan ke tabel detail
        for ($i = 0; $i < $count; $i++) {
            $barangKey = 'barang_' . $i;
            $jumlahKey = 'jumlah_' . $i;
            $hargaKey = 'hargasatuan_' . $i;

            $request->validate([
                $barangKey => 'required',
                $jumlahKey => 'nullable|numeric',
                $hargaKey  => 'nullable|numeric'
            ]);

            $detail_id = $request->id . '_' . rand(1, 10000);

            DB::table('permintaan_detail')->insert([
                'permintaan_detail_id'           => $detail_id,
                'permintaan_header_id'           => $request->id,
                'barang_id'                      => $request->$barangKey,
                'permintaan_detail_jumlah'       => $request->$jumlahKey,
                'permintaan_detail_harga'        => $request->$hargaKey
            ]);
        }

        // Ambil data lengkap untuk dicetak atau ditampilkan
        $data = DB::table('permintaan_header')
            ->leftJoin('permintaan_detail', 'permintaan_detail.permintaan_header_id', '=', 'permintaan_header.permintaan_header_id')
            ->leftJoin('masterbarang', 'masterbarang.barang_id', '=', 'permintaan_detail.barang_id')
            ->leftJoin('masterunit', 'masterunit.unit_id', '=', 'permintaan_header.unit_id')
            ->where('permintaan_header.permintaan_header_id', '=', $request->id)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data saved successfully',
            'data'    => $data
        ], 200);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while processing the request',
            'error'   => $e->getMessage()
        ], 500);
    }
}

    // public function store(Request $request)
    // {
        
    //     $userid = '033123';
    //     // Mengambil data dari form tambah
    //     $request->validate([
    //         'id'            => 'required',
    //         'supplier'      => 'required',
    //         'keterangan'    => 'required',
    //         'namakaryawan'  => 'required',
    //         'nomor'         => 'required',
    //         'unitbagian'    => 'required'
    //     ]);
    //     //dd($request);
    //     // Mencari data unit berdasarkan pengguna id
    //     // Ini belum dibutuhkan
    //     $data = DB::table('pengguna')
    //             ->where('pengguna_id', '=', $userid)
    //             ->get(); 
        
    //     // Memasukan data unit id untuk masuk ke variabel $unit_id
    //     foreach($data as $item){
    //         $unit_id = $item->unit_id;
    //     }
        
    //     $date = date('Y-m-d');
    //     $count = $request->nomor;

    //     // Memasukan data ke dalam database tabel header
    //      DB::table('permintaan_header')->insert([
    //         'permintaan_header_id'          => $request->id,
    //         'permintaan_header_tgl'         => $date,
    //         'pengguna_id'                   => $userid,
    //         'unit_id'                       => $request->unitbagian,
    //         'supplier_id'                   => $request->supplier,
    //         'permintaan_header_keterangan'  => $request->keterangan,
    //         'karyawan'                      => $request->namakaryawan
    //     ]);
    //     //return redirect('permintaan')->with('sukses', 'Data User Berhasil ditambah!');
    //     // Perulangan untuk masuk ke tabel permintaan detail
    //     for($i = 0; $i < $count; $i++){
    //         $request->validate([
    //             'barang_'.$i        => 'required',
    //             'jumlah_'.$i        => 'nullable',
    //             'hargasatuan_'.$i   => 'nullable'
    //         ]);
            
    //         //dd($request);
    //         $detail_id = $request->id.'_'.rand(1,10000);
    //         // memasukan data ke dalam tabel permintaan detail
    //         DB::table('permintaan_detail')->insert([
    //            'permintaan_detail_id'           => $detail_id,
    //            'permintaan_header_id'           => $request->id,
    //            'barang_id'                      => $request->{'barang_'.$i},
    //            'permintaan_detail_jumlah'       => $request->{'jumlah_'.$i},
    //            'permintaan_detail_harga'        => $request->{'hargasatuan_'.$i}
    //         ]);
            
    //     }
    //     // Mengambil Data untuk kemudian di cetak
    //     $data = DB::table('permintaan_header')
    //             ->leftjoin('permintaan_detail', 'permintaan_detail.permintaan_header_id', '=', 'permintaan_header.permintaan_header_id')
    //             ->leftjoin('masterbarang', 'masterbarang.barang_id', '=', 'permintaan_detail.barang_id')
    //             ->leftjoin('masterunit', 'masterunit.unit_id', '=', 'permintaan_header.unit_id')
    //             ->where('permintaan_header.permintaan_header_id', '=', $request->id)
    //             ->get();
    //     return view('permintaan.print', ['data' => $data]);
    //     //return redirect('/permintaan');
    //     //return redirect('permintaan')->with('sukses', 'Data User Berhasil ditambah!');

    // }

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
            $datanalisa[] = $request->input('analisa_'.$i);
            
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
        'datanalisa'    => $datanalisa,
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

        $action = $request->input('action');
        //dd($tahun, $bulan, $action);
        if ($action == 'generate') {
            $generateData = $this->repoPermintaan->generate($bulan, $tahun);

            $dataunitid = $generateData[0];
            $dataunitnama = $generateData[1];
            $dataharga = $generateData[2];
            $data = $generateData[3];

            //dd($dataunitid, $dataunitnama, $dataharga, $data);
            //dd($bulan, $tahun);
            return view('permintaan.laporan', [
                'data'          => $data,
                'dataunitid'    => $dataunitid,
                'dataunitnama'  => $dataunitnama,
                'dataharga'     => $dataharga,
                'bulan'         => $bulan,
                'tahun'         => $tahun
            ]);
        } elseif ($action == 'export') {
            // Logika untuk tombol Export Spreadsheet
            // dd($tahun, $bulan);
            echo "masuk export";
        } else {
            $bulan = Carbon::now()->format('m'); // Mendapatkan nilai bulan sekarang (format: 01, 02, ..., 12)
            $tahun = Carbon::now()->format('Y'); // Mendapatkan nilai tahun sekarang (format: 2023, 2024, dsb.)
            $generateData = $this->repoPermintaan->generate($bulan, $tahun);
            
            $dataunitid = $generateData[0];
            $dataunitnama = $generateData[1];
            $dataharga = $generateData[2];
            $data = $generateData[3];

            //dd($dataunitid, $dataunitnama, $dataharga, $data);
            return view('permintaan.laporan', [

                'data'          => $data,
                'dataunitid'    => $dataunitid,
                'dataunitnama'  => $dataunitnama,
                'dataharga'     => $dataharga,
                'bulan'         => $bulan,
                'tahun'         => $tahun
            ]);

        }    
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

    public function getLimit(Request $request)
    {
        $unit = $request->input('unit');
        // dd($unit);
        $data = DB::table('masterunit')
                ->where('unit_nama', '=', $unit)
                ->get();

        return response()->json($data);
    }

    public function getPermintaan(Request $request)
    {
        $unit = $request->input('unit');
        $tanggal = $request->input('tanggal');
        \Log::info("Unit: $unit, Tanggal: $tanggal");

        // Pastikan tanggal tidak kosong dan formatnya benar
        if (!$tanggal) {
            return response()->json(['error' => 'Tanggal tidak valid.'], 400);
        }

        $bulan = (int) date('m', strtotime($tanggal)); // Cast to integer
        $tahun = (int) date('Y', strtotime($tanggal)); // Cast to integer

        // Cek apakah bulan dan tahun sudah terisi dengan benar
        \Log::info("Bulan: $bulan, Tahun: $tahun");

        // Query untuk mengambil data berdasarkan unit, bulan, dan tahun
        $data = DB::table('permintaan_detail')
            ->join('permintaan_header', 'permintaan_header.permintaan_header_id', '=', 'permintaan_detail.permintaan_header_id')
            ->join('masterunit', 'masterunit.unit_id', '=', 'permintaan_header.unit_id')
            ->where('masterunit.unit_nama', '=', $unit)
            ->whereMonth('permintaan_header.permintaan_header_tgl', '=', $bulan) // Menggunakan whereMonth untuk mencocokkan bulan
            ->whereYear('permintaan_header.permintaan_header_tgl', '=', $tahun) // Menggunakan whereYear untuk mencocokkan tahun
            ->select(
                'permintaan_detail.permintaan_detail_id',
                'permintaan_detail.permintaan_header_id',
                'permintaan_detail.barang_id',
                'permintaan_detail.permintaan_detail_jumlah',
                'permintaan_detail.permintaan_detail_harga',
                'permintaan_header.permintaan_header_id',
                'permintaan_header.permintaan_header_tgl',
                'permintaan_header.unit_id',
                'masterunit.unit_nama'
            )
            ->get();

        // Debug untuk memastikan query mengembalikan data
        \Log::info("Data: ", $data->toArray());
        // dd($data);
        // Jika data kosong, beri respons
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }
        
        // Mengembalikan data sebagai JSON
        return response()->json($data);
    }
}

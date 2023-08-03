<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('masterbarang')
                ->orderBy('barang_nama','asc')
                ->get();
 
        return view('masterbarang.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'barang_nama' => '',
            'barang_harga' => '',
            'barang_satuan' => '0'
        ];
        return view('masterbarang.create');
        //return view('masterbarang.CreateOrEdit', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengambil data dari form tambah
        $request->validate([
            'id'        => 'required',
            'nama'      => 'required',
            'harga'     => 'required',
            'satuan'    => 'required'
        ]);
        $random_number = rand(2,1000000);

        // Memasukan data ke dalam database
        DB::table('masterbarang')->insert([
            'barang_id' => $request->id,
            'barang_nama' => $request->nama,
            'barang_harga' => $request->harga,
            'barang_satuan' => $request->satuan
        ]);

        return redirect('masterbarang')->with('sukses', 'Data User Berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterBarang $masterBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        //dd($id);
        $data = DB::table('masterbarang')
                ->where('barang_id', '=', $id)
                ->get();
        return view('masterbarang.CreateOrEdit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterBarang $masterBarang)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'satuan' => 'required'
        ]);

        DB::table('masterbarang')
                ->where('barang_id', $request->id)
                ->update([
                    'barang_nama' => $request->nama,
                    'barang_harga' => $request->harga,
                    'barang_satuan' => $request->satuan
                ]);
        return redirect('masterbarang')->with('sukses', 'Data User Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterBarang $masterBarang)
    {
        //
    }
}

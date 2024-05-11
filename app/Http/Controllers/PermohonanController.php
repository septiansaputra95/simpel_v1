<?php

namespace App\Http\Controllers;

use App\Models\PermohonanModel;
use App\Models\PermohonanDetailModel;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $permohonanModel;
    protected $permohonanDetailModel;

    public function __construct()
    {
        $this->permohonanModel = new PermohonanModel();
        $this->permohonanDetailModel = new PermohonanDetailModel();
    }
    
    public function index()
    {
        $data = $this->permohonanModel->ambilData();
        // dd($data);
        return view('permohonan/index', ['data' => $data]);
        //return view('permohonan/index', ['data' => $data]);
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
    public function show($id)
    {
        //
        // echo $id;
        $data = $this->permohonanModel->detailData($id);
        //dd($data);
        return view('permohonan/detail', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermohonanModel $permohonanModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
        $data = $this->permohonanModel->ubahdata($id);
        return redirect()->route('permohonan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermohonanModel $permohonanModel)
    {
        //
    }

    public function checkNotification()
    {
        $data = PermohonanModel::where('proseskirim', 0)->exists();

        return response()->json(['hasUnprocessedData' => $data]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermohonanModel extends Model
{
    use HasFactory;
    protected $table = 'permohonanhasilheader'; // Pastikan nama tabel sesuai dengan yang digunakan
    protected $primaryKey = 'idheader';
    public $timestamps = false;
    // protected $tableDetail = 'permohonanhasildetail';

    public function __construct()
    {
        $tableDetail = 'permohonanhasildetail';
    }

    public function ambilData()
    {
        //data = PermohonanModel::all();
        $data = PermohonanModel::where('proseskirim', 0)->get();
        
        return $data;
    }

    public function detailData($id)
    {
        $data = DB::table($this->table)
                ->join('permohonanhasildetail', 'permohonanhasilheader.idheader', '=', 'permohonanhasildetail.idheader')
                ->select('permohonanhasilheader.*', 'permohonanhasildetail.*')
                ->where('permohonanhasildetail.idheader', $id)
                ->get();

        return $data;
    }

    public function ubahdata($id)
    {
        $data = PermohonanModel::find($id);
        $data->proseskirim = '1';
        $data->save();
    }
}

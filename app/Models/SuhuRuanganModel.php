<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuhuRuanganModel extends Model
{
    use HasFactory;
    protected $table = 'suhuruangan';

    public function getAllMasterUnitData()
    {
        return \App\Models\MasterUnitModel::orderBy('unit_id', 'asc')->get();
    }
    
    public function getDataByUnitBulanTahun($unitId, $bulan, $tahun)
    {
        return $this->join('masterunit', 'suhuruangan.unit_id', '=', 'masterunit.unit_id')
                    ->where('suhuruangan.unit_id', $unitId)
                    ->whereMonth('suhuruangan.tanggal', $bulan)
                    ->whereYear('suhuruangan.tanggal', $tahun)
                    ->orderBy('suhuruangan.idsuhuruangan', 'ASC')
                    ->get();
    }
}

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
        return $this->where('unit_id', $unitId)
                    ->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun)
                    ->orderBy('idsuhuruangan', 'ASC')
                    ->get();
    }
}

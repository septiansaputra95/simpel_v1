<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanDetailModel extends Model
{
    use HasFactory;
    protected $table = 'permohonanhasildetail';

    public function detailData($id)
    {
        $data = PermohonanDetailModel::where('idheader', $id)->get();
        return $data;
    }
}

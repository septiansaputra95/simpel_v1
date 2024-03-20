<?php

namespace App\Exports;

use App\Models\Permintaan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PermintaanExport implements FromCollection
{
    public function collection()
    {
        // Ambil data dari model atau dari sumber data lainnya
        return Permintaan::all();
    }
}
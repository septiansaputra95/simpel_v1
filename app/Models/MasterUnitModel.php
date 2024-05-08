<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitModel extends Model
{
    use HasFactory;
    protected $table = 'masterunit'; // Sesuaikan dengan nama tabel Anda
    // Sesuaikan kolom yang fillable atau guardable jika perlu
}

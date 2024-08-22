<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dacu extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan
    protected $table = 'dacus';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'total_cuti',
        'sisa_cuti',
        'status'
    ];
}

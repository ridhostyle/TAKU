<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'mulai_cuti',
        'selesai_cuti',
        'jenis_cuti',
        'alasan_cuti',
        'status',
    ];

    // Menambahkan nilai default saat membuat model baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->status)) {
                $model->status = 'menunggu';
            }
        });
    }
}

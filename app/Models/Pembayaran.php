<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    public $timestamps = false;

    protected $fillable = [
        'id_iuran',
        'tanggal_bayar',
        'nominal',
        'metode',
        'bukti_bayar',
        'status_verifikasi',
        'diverifikasi_oleh',
        'tanggal_verifikasi',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'nominal' => 'decimal:2',
    ];
}


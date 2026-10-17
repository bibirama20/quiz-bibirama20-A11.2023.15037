<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;

class Periksa extends Model
{
    protected $table = 'periksa';

    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];

    public function daftarPoli()
    {
        return $this->belongsTo(
            DaftarPoli::class,
            'id_daftar_poli'
        );
    }

    public function detailPeriksa()
    {
        return $this->hasMany(
            DetailPeriksa::class,
            'id_periksa'
        );
    }
}
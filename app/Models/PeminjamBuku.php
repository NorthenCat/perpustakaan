<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamBuku extends Model
{
    protected $table = 'peminjam_buku';
    protected $fillable = [
        'user_id',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali',
        'returned'
    ];

    //casts (gunanya buat bisa menggunakan helper function seperti format tanggal dari laravel)
    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(KoleksiBuku::class, 'buku_id', 'id');
    }
}

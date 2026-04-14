<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIKASI = 'verifikasi';
    const STATUS_PROSES = 'proses';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DITOLAK = 'ditolak';

    public static function getStatusLabels()
    {
        return [
            self::STATUS_PENDING => 'Menunggu',
            self::STATUS_VERIFIKASI => 'Verifikasi',
            self::STATUS_PROSES => 'Diproses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    public static function getStatusColors()
    {
        return [
            self::STATUS_PENDING => 'orange',
            self::STATUS_VERIFIKASI => 'blue',
            self::STATUS_PROSES => 'purple',
            self::STATUS_SELESAI => 'green',
            self::STATUS_DITOLAK => 'red',
        ];
    }

    protected $fillable = [
        'no_tiket',
        'user_id',
        'nama_pengirim',
        'nisn_pengirim',
        'kelas_id',
        'lokasi_id',
        'kategori_id',
        'deskripsi',
        'foto_bukti',
        'kontak',
        'is_anonim',
        'status',
        'catatan_admin',
        'feedback',
        'diproses_at',
        'selesai_at'
    ];

    protected $casts = [
        'is_anonim' => 'boolean',
        'diproses_at' => 'datetime',
        'selesai_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSarana::class, 'kategori_id');
    }

    public function histories()
    {
        return $this->hasMany(TicketHistory::class);
    }

    public function generateNoTiket()
    {
        $prefix = 'TCK';
        $date = now()->format('Ymd');
        $random = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        return $prefix . $date . $random;
    }

    public function kelas() // Tambahkan relasi ini
    {
        return $this->belongsTo(Kelas::class);
    }
}
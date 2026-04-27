<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    protected $fillable = [
        'user_id',
        'lawyer_id',
        'brief_case',
        'status',
        'payment_status',
        'midtrans_snap_token',
        'metadata'
    ];

    // Cast metadata agar otomatis jadi array/object saat dipanggil
    protected $casts = [
        'metadata' => 'array',
    ];

    // Relasi ke Pasien
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Lawyer
    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }
}

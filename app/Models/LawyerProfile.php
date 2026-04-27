<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LawyerProfile extends Model
{
    // Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'specialization',
        'base_price',
        'bio',
        'license_number',
        'rating'
    ];

    // Relasi balik ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

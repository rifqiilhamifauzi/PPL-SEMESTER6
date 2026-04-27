<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequiredDocument extends Model
{
    protected $fillable = ['claim_category_id', 'document_name', 'is_mandatory'];

    public function claimCategory(): BelongsTo
    {
        return $this->belongsTo(ClaimCategory::class);
    }
}

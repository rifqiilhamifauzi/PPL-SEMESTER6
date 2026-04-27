<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClaimCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function requiredDocuments(): HasMany
    {
        return $this->hasMany(RequiredDocument::class);
    }
}

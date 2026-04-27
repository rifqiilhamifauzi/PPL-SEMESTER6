<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LawyerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'email' => $this->email,
        'role' => $this->role,
        'profile' => $this->lawyerProfile ? [
            'specialization' => $this->lawyerProfile->specialization,
            'base_price' => $this->lawyerProfile->base_price,
            'bio' => $this->lawyerProfile->bio,
            'rating' => $this->lawyerProfile->rating,
        ] : null // Jika profil tidak ada, kirim null bukan error
    ];
}
}

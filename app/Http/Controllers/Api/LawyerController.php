<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\LawyerResource;
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    public function index()
{
    // Hanya ambil user role lawyer yang SUDAH punya lawyerProfile
    $lawyers = User::where('role', 'lawyer')
                 ->has('lawyerProfile')
                 ->with('lawyerProfile')
                 ->get();

    return response()->json([
        'success' => true,
        'message' => 'Daftar pengacara berhasil diambil',
        'data' => LawyerResource::collection($lawyers)
    ]);
}
}

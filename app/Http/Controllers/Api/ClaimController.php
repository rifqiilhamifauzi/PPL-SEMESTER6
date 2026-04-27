<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClaimCategory;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori beserta dokumen wajibnya (Eager Loading)
        $categories = ClaimCategory::with('requiredDocuments')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar kategori klaim berhasil diambil',
            'data'    => $categories
        ], 200);
    }
}

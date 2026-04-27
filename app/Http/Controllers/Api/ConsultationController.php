<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lawyer_id' => 'required|exists:users,id',
            'brief_case' => 'required|string|min:20',
        ]);

        $consultation = Consultation::create([
            'user_id' => auth()->id(), // Ambil ID dari user yang sedang login
            'lawyer_id' => $request->lawyer_id,
            'brief_case' => $request->brief_case,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat. Silahkan lanjut ke pembayaran.',
            'data' => $consultation
        ], 201);
    }

    public function myConsultations()
    {
        // Melihat daftar konsultasi saya sebagai pasien
        $data = Consultation::with('lawyer.lawyerProfile')
                ->where('user_id', auth()->id())
                ->get();

        return response()->json(['data' => $data]);
    }
}

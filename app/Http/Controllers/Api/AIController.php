<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;

class AIController extends Controller
{
    public function navigator(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        // Memberikan "peran" dan konteks agar AI tidak asal jawab
        $systemPrompt = "Anda adalah MyBiro Navigator, asisten ahli birokrasi kesehatan di Indonesia.
        Tugas Anda membantu user memahami syarat sengketa klaim BPJS dan asuransi.
        Jawablah dengan sopan, empati, dan to-the-point.";

        $fullPrompt = $systemPrompt . "\n\nPertanyaan User: " . $request->question;

        try {
            $model = env('GEMINI_MODEL', 'gemini-2.5-flash');
            $result = Gemini::generativeModel($model)->generateContent($fullPrompt);

            return response()->json([
                'success' => true,
                'answer' => $result->text()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung ke AI: ' . $e->getMessage()
            ], 500);
        }
    }
}

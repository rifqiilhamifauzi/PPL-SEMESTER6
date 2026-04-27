<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClaimController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LawyerController;
use App\Http\Controllers\Api\ConsultationController;
use Gemini\Laravel\Facades\Gemini;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('public')->group(function () {
    Route::get('/categories', [ClaimController::class, 'index']);
    Route::get('/lawyers', [LawyerController::class, 'index']);
});

/*
|--------------------------------------------------------------------------
| AI ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('ai')->group(function () {

    // Public test AI
    Route::get('/test-ai', function () {
        try {
            $model = env('GEMINI_MODEL', 'gemini-2.5-flash');
            $result = Gemini::generativeModel($model)
                ->generateContent('Halo MyBiro!');
            return response()->json(['jawaban' => $result->text()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    // Navigator route using AIController
    Route::post('/navigator', [\App\Http\Controllers\Api\AIController::class, 'navigator']);

    // Protected AI (kalau nanti butuh login)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/ask', function (Request $request) {
            try {
                $model = env('GEMINI_MODEL', 'gemini-2.5-flash');
                $result = Gemini::generativeModel($model)->generateContent($request->input('prompt'));
                return response()->json(['jawaban' => $result->text()]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        });
    });
});

/*
|--------------------------------------------------------------------------
| USER & CONSULTATIONS (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // User
    Route::prefix('user')->group(function () {
        Route::get('/', function (Request $request) {
            return $request->user();
        });
    });

    // Consultations
    Route::prefix('consultations')->group(function () {
        Route::post('/', [ConsultationController::class, 'store']);
        Route::get('/my', [ConsultationController::class, 'myConsultations']);
    });

});

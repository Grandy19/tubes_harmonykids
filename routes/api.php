<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// CONTROLLERS
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Wali\Controllers\ProfileController;
use App\Modules\Wali\Controllers\SettingsController;
use App\Modules\Wali\Controllers\LikedController;
use App\Modules\Wali\Controllers\NotifikasiController;
use App\Modules\Instansi\Controllers\InstansiController;
use App\Modules\Forum\Controllers\ForumController;
use App\Modules\HarmoTalent\Controllers\HarmoTalentController;
use App\Modules\Pendaftaran\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| API Routes - HarmonyKids Mobile
|--------------------------------------------------------------------------
| 
| API endpoints untuk Flutter mobile app.
| Semua endpoint protected menggunakan auth:sanctum middleware.
|
*/

// ============================================================================
// PUBLIC ROUTES (Tidak perlu login)
// ============================================================================

// Health Check
Route::get('/test', function(){
    return response()->json([
        'status' => 'success', 
        'message' => 'API HarmonyKids Ready',
        'timestamp' => now()->toISOString()
    ], 200);
});

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register/wali', [AuthController::class, 'register']);
Route::post('/register/pengelola', [AuthController::class, 'registerPengelola']);

// ============================================================================
// PROTECTED ROUTES (Harus login dengan Sanctum token)
// ============================================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // ------------------------------------------------------------------------
    // AUTH & USER
    // ------------------------------------------------------------------------
    
    // Get current authenticated user
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // ------------------------------------------------------------------------
    // PROFILE MANAGEMENT
    // ------------------------------------------------------------------------
    
    // Get user profile
    Route::get('/profile', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });
    
    // Update profile
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile', [ProfileController::class, 'update']); // Support POST for multipart/form-data
    
    // Change password
    Route::put('/settings/password', [SettingsController::class, 'updatePassword']);
    
    // ------------------------------------------------------------------------
    // INSTANSI (Institution Management)
    // ------------------------------------------------------------------------
    
    // List all approved institutions with filters
    Route::get('/instansi', [InstansiController::class, 'index']);
    
    // Get institution detail
    Route::get('/instansi/{id}', [InstansiController::class, 'show']);
    
    // Toggle like/unlike institution
    Route::post('/instansi/{id}/like', [LikedController::class, 'toggle']);
    
    // Get user's liked institutions
    Route::get('/liked', [LikedController::class, 'index']);
    
    // ------------------------------------------------------------------------
    // FORUM (HarmoTalk)
    // ------------------------------------------------------------------------
    
    // Get forum posts with filters (tab, sort)
    Route::get('/forum', [App\Modules\Forum\Controllers\ForumApiController::class, 'index']);
    
    // Create new forum post
    Route::post('/forum', [App\Modules\Forum\Controllers\ForumApiController::class, 'store']);
    
    // Toggle like/unlike post
    Route::post('/forum/{id}/like', [App\Modules\Forum\Controllers\ForumApiController::class, 'like']);
    
    // Get post comments
    Route::get('/forum/{id}/comments', [App\Modules\Forum\Controllers\ForumApiController::class, 'getComments']);
    
    // Add comment to post
    Route::post('/forum/{id}/comment', [App\Modules\Forum\Controllers\ForumApiController::class, 'storeComment']);
    
    // ------------------------------------------------------------------------
    // HARMOTALENT
    // ------------------------------------------------------------------------
    
    // Get talent recommendations (pass bakat, kategori, sort as query params)
    // This endpoint will use InstansiController::index with bakat filter
    Route::get('/harmotalent/recommendations', [InstansiController::class, 'index']);
    
    // ------------------------------------------------------------------------
    // PENDAFTARAN (Registration to Institution)
    // ------------------------------------------------------------------------
    
    // Submit registration to institution
    Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
    
    // Get user's registration history
    Route::get('/pendaftaran', function (Request $request) {
        $pendaftaran = \App\Modules\Pendaftaran\Models\Pendaftaran::with('instansi')
            ->where('wali_id', $request->user()->id)
            ->latest()
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $pendaftaran
        ]);
    });
    
    // ------------------------------------------------------------------------
    // NOTIFICATIONS
    // ------------------------------------------------------------------------
    
    // Get notifications (based on pendaftaran status changes)...
    Route::get('/notifications', [NotifikasiController::class, 'index']);
    
});
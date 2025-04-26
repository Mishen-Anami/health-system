<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Http\Request;
use app\Models\User;

// Login route
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $user = auth()->user(); // this must return a User object
        $token = $user->createToken('auth_token')->plainTextToken; 

        return response()->json(['token' => $token]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
});


// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/programs', [ProgramController::class, 'index']);
    Route::post('/programs', [ProgramController::class, 'store']);
    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::get('/clients/{id}', [ClientController::class, 'show']);
    Route::middleware('auth:sanctum')->post('/enrollments', [EnrollmentController::class, 'store']);
    //Route::post('/enrollments', [EnrollmentController::class, 'store']);
});

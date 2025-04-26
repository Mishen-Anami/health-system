<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\AuditLog;
use App\Http\Requests\StoreEnrollmentRequest;

class EnrollmentController extends Controller {
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'program_id' => 'required|exists:programs,id',
            'enrollment_date' => 'required|date',
        ]);
    
        $enrollment = Enrollment::create($validated);
    
        return response()->json([
            'message' => 'Client enrolled successfully',
            'data' => $enrollment
        ], 201);
    }
    

    public function index() {}
    public function show($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
<?php

namespace App\Http\Controllers;
use App\Models\AuditLog;
use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use Illuminate\Http\Request;

class ProgramController extends Controller {
    public function index() {
        return response()->json(Program::all());
    }

    public function store(StoreProgramRequest $request) {
        $program = Program::create($request->validated());
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'program_created',
            'details' => "Program {$program->id} created",
        ]);
        return response()->json($program, 201);
    }

    // Note: Only index and store are needed for this task
    public function show($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
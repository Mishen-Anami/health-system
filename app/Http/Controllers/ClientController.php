<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\AuditLog;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller {
    public function index(Request $request) {
        $query = $request->query('search');
        $clients = Client::when($query, function ($q) use ($query) {
            return $q->where('first_name', 'like', "%$query%")
                     ->orWhere('last_name', 'like', "%$query%")
                     ->orWhere('email', 'like', "%$query%");
        })->get();
        return response()->json($clients);
    }

    public function store(StoreClientRequest $request) {
        $client = Client::create($request->validated());
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'client_registered',
            'details' => "Client {$client->id} registered",
        ]);
        return response()->json($client, 201);
    }

    public function show($id) {
        $client = Client::with('programs')->findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
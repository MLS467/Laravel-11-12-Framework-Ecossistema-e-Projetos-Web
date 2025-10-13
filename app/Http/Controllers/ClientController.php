<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function status(): string
    {
        return "status ok";
    }

    public function index(): JsonResponse
    {
        $clients = Client::all()->take(5);

        if (!$clients)
            return response()->json([], 404);

        return response()->json(compact('clients'), 200);
    }

    public function pagination(): JsonResponse
    {
        $clients = Client::paginate(10);

        if (!$clients)
            return response()->json([], 404);

        return response()->json(compact('clients'), 200);
    }

    public function show($client): JsonResponse
    {
        try {
            $client_found = Client::find($client);

            if (!$client_found) throw new ModelNotFoundException('Client Not Fount');

            return response()->json(compact('client_found'), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function client_by_id(Request $request)
    {
        $client = Client::find($request->id);

        if (!$request->id || !$client) {
            return response()->json(['message' => 'id not found'], 404);
        }

        return response()->json(
            [
                'message' => 'success client found',
                'data' => $client
            ],
            404
        );
    }
}
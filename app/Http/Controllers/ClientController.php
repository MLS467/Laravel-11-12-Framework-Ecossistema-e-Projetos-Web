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


    public function add_client(Request $request)
    {
        $client_instance = new Client();

        $client_instance->name = $request->name;
        $client_instance->email = $request->email;
        $client_instance->save();

        return response()->json(['message' => 'created with success', 'data' => $client_instance], 201);
    }


    public function update_client(Request $request, $id)
    {

        $client_instance = Client::find($id);
        $client_instance->name = $request->name;
        $client_instance->email = $request->email;
        $client_instance->save();

        return response()->json(['message' => 'updated with success', 'data' => $client_instance], 200);
    }


    public function delete_client($id): JsonResponse
    {
        $client = Client::find($id);
        $client->delete();

        return response()->json(['message' => 'deleted with success'], 200);
    }
}
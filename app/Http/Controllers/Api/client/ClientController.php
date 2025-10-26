<?php

namespace App\Http\Controllers\Api\client;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponse;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth()->user()->tokenCan("client:list"))
            return ApiResponse::error(401, 'Não autorizado para essa função');

        $data = Client::all();

        return ApiResponse::success($data, 200, 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        if (!Auth()->user()->tokenCan("client:store"))
            return ApiResponse::error(401, 'Não autorizado para essa função');

        $this->validateClientStore($request);

        $client = Client::create($request->all());

        return ApiResponse::success($client, 201, 'cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        if (!Auth()->user()->tokenCan("client:details"))
            return ApiResponse::error(401, 'Não autorizado para essa função');

        $data = Client::find($id);

        if (!$data)
            return ApiResponse::error(404, 'Usuário não encontrado!');

        return ApiResponse::success($data, 200, 'Usuário encontrado!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!Auth()->user()->tokenCan("client:update"))
            return ApiResponse::error(401, 'Não autorizado para essa função');

        $this->validateClientStore($request);

        $data = Client::find($id)
            ->update($request->all());

        if (!$data)
            return ApiResponse::error(404, 'Usuário não encontrado!');

        $client_updated = Client::find($id);

        return ApiResponse::success($client_updated, 200, 'Usuário atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth()->user()->tokenCan("client:destroy"))
            return ApiResponse::error(401, 'Não autorizado para essa função');

        $result = Client::find($id)->delete();

        if (!$result)
            return ApiResponse::error(401, 'Usuário não pode ser excluido!');

        return ApiResponse::success([], 200, 'Usuário excluido!');
    }

    private function validateClientStore(Request $request)
    {

        $update_validate =   [
            'name' => 'string|min:3|max:50',
            'email' => 'email|unique:clients',
            'phone' => 'nullable|size:10',
        ];

        $store_validate =   [
            'name' => 'string|required|min:3|max:50',
            'email' => 'email|required|unique:clients',
            'phone' => 'nullable|size:10',
        ];

        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'phone.size' => 'O campo telefone deve ter exatamente :size caracteres.',
        ];


        $request->validate(
            $request->method() === 'POST' ? $store_validate : $update_validate,
            $messages
        );
    }
}
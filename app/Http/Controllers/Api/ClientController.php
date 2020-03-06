<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $query = $this->client->orderBy($request->column, $request->order);
        $clients = $query->paginate($request->per_page ?? 5);

        return ClientResource::collection($clients);
    }
}

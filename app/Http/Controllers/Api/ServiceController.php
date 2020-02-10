<?php

namespace App\Http\Controllers\Api;

use App\Service;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = $this->service->orderBy($request->column, $request->order);
        $clients = $query->paginate($request->per_page ?? 5);

        return ServiceResource::collection($clients);
    }
}

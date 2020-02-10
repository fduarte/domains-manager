<?php

namespace App\Http\Controllers\Api;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Http\Resources\DomainResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    protected $domain;

    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    public function index(Request $request)
    {
        $query = $this->domain->orderBy($request->column, $request->order);
        $domains = $query->paginate($request->per_page ?? 5);

        return DomainResource::collection($domains);
    }

    /*
    public function index()
    {
//        return DomainResource::collection(auth()->domains()->with('creator')->latest()->paginate(4));
        return DomainResource::collection(Domain::all());
    }
    */

    public function store(Request $request)
    {
        $request->validate([
            'domain_name' => 'required|max:255',

        ]);

        $data = $request->all();

        if ($request->has('domain_created_date')) {
           $data['domain_created_date'] = Carbon::parse($request->domain_created_date)->toDateTimeString();
        }

        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $domain = new Domain();
        $domain->create($data);
    }

    public function add()
    {
        return view('domains.add');
    }

    public function create()
    {
        $domain = new Domain();
        $domain->domain_name = request('domain_name');
        $domain->domain_created_date = request('domain_created_date');
    }

}

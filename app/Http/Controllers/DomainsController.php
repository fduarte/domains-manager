<?php

namespace App\Http\Controllers;

use App\Domain;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DomainsController extends Controller
{

    public function index()
    {
        $domains = Domain::all();

        return view('domains.index', compact('domains'));

    }


    public function create()
    {
        $domain = new Domain();
        $domain->name = request('name');

        $domain->save();

        return redirect('/domains');

    }

}

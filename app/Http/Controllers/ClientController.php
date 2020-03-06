<?php

namespace App\Http\Controllers;

use App\Client;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//        $clients = Client::all()->sortBy('name')->pluck('name', 'id');
        $services = Service::all()->sortBy('name')->pluck('name', 'id');

        return view('client.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'min:10|max:15',
        ]);

        $client = Client::create($request->all());

        $client->services()->attach($request->services);

        $message = 'Client created successfully: ' . $request->name;

        // Save message to session so it's displayed in view
        $request->session()->flash('status', $message);

        return Redirect::to('/clients')
            ->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where(['id' => $id])->first();
        $services = Service::all()->sortBy('name')->pluck('name', 'id');

        $clientServices = [];
        foreach ($client->services as $cs) {
            $clientServices[] = $cs->pivot->service_id;
        }

        return view('client.edit', compact( 'client', 'services', 'clientServices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'min:10|max:15',
        ]);

        $update = [
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'services'=> $request->services
        ];

        $client = Client::findOrFail($request->id);

        if ($client->update($update)) {
            $client->services()->detach();
            $client->services()->attach($request->services);
        }

        return Redirect::to('/clients')
            ->with('success', 'Client updated successfully: ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $clientName = $client->name;
        $client->delete();

        return Redirect::to('/clients')
            ->with('success', 'Client deleted: ' . $clientName);
    }
}

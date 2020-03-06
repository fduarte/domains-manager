<?php

namespace App\Http\Controllers;

use App\Client;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'max:11',
        ]);

        $service = Service::create($request->all());

        $message = 'Service created successfully: ' . $request->name;

        // Save message to session so it's displayed in view
        $request->session()->flash('status', $message);

        return Redirect::to('/services')
            ->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $service = Service::where(['id' => $id])->first();

        return view('service.edit', compact('service'));
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
            'price' => 'max:10000|numeric',
        ]);

        $update = [
            'name' => $request->name,
            'price' => $request->price,
        ];

        $service = Service::findOrFail($request->id);

        $service->update($update);

        return Redirect::to('/services')
            ->with('success', 'Service updated successfully: ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $serviceName = $service->name;
        $service->delete();

        return Redirect::to('/services')
            ->with('success', 'Service deleted: ' . $serviceName);
    }
}


<?php

namespace App\Http\Controllers;

use App\Client;
use App\Domain;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class DomainController extends Controller
{

    /**
     * This method grabs domain data and passes it into the index datatable
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return view('domain.index');
    }


    /**
     * Display create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $clients = Client::all()->sortBy('name')->pluck('name', 'id');

        return view('domain.create', compact('clients'));
    }

    /**
     * Save new Domain
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'domain_name' => 'required|unique:domains|max:255',
            'client_id' => 'required',
        ]);

        $domain = Domain::firstOrCreate(
            ['domain_name' => $request->domain_name],
            $request->all()
        );

        $message = 'Domain created successfully.';

        // Save message to session so it's displayed in view
        $request->session()->flash('status', $message);

        return Redirect::to('/')
            ->with('success', $message);
    }

    /**
     * Display edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $domain = Domain::where(['id' => $id])->first();

        // @todo - need to get the correct client
        $clients = Client::all()->sortBy('name')->pluck('name', 'id');

        return view('domain.edit', compact('domain', 'clients'));
    }

    /**
     * Update domain thru edit form
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'domain_name' => 'required|max:255',
            'client_id' => 'required',
        ]);

        $update = [
            'domain_name' => $request->domain_name,
            'client_id' => $request->client_id
        ];

        Domain::where('id', $request->id)->update($update);

        return Redirect::to('/')
            ->with('success', 'Domain updated successfully: ' . $request->domain_name);
    }

    /**
     * Delete domain
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        $domainName = $domain->domain_name;
        $domain->delete();

        return Redirect::to('/')
            ->with('success', 'Domain deleted: ' . $domainName);
    }


}

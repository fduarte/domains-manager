<?php

namespace App\Http\Controllers;

use App\Client;
use App\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

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

//        if ($request->ajax()) {
//
//            $data = Domain::all();
//
//            return DataTables::of($data)
//                ->addColumn('client', function($data) {
//                   return $data->client->name;
//                })
//                ->addColumn('action', function($data) {
//                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
//
//                    $button .= '&nbsp; <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" >Delete</button>';
//
//                    return $button;
//                })
//                ->rawColumns(['client', 'action'])
//                ->make(true);
//        }

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


        return view('domain.create', ['clients' => $clients]);

//        $domain = new Domain();
//        $domain->name = request('name');
//
//        $domain->save();
//
//        return redirect('/');
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
            'domain_name' => 'required|max:255',
            'client_id' => 'required',
        ]);

        Domain::create($request->all());

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
        $data['domain_id'] = Domain::where(['id' => $id])->first();
        return view('domain.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'domain_name' => 'required|max:255',
            'client_id' => 'required',
        ]);

        $update = [
            'domain_name' => $request->domain_name,
            'client_id' => $request->client_id
        ];

        Domain::where('id', $id)->update($update);

        return Redirect::to('domains')
            ->with('success', 'Domain updated successfully.');
    }

    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        $domain->delete();

        return Redirect::to('/')
            ->with('success', 'Domain deleted.');
    }





}

<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
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

        if ($request->ajax()) {

            $data = Domain::all();

            return DataTables::of($data)
                ->addColumn('client', function($data) {
                   return $data->client->name;
                })
                ->addColumn('action', function($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';

                    $button .= '&nbsp; <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" >Delete</button>';

                    return $button;
                })
                ->rawColumns(['client', 'action'])
                ->make(true);
        }

        return view('domain.index');
    }


    public function create()
    {
        $domain = new Domain();
        $domain->name = request('name');

        $domain->save();

        return redirect('/');

    }

}

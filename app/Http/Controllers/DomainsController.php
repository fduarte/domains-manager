<?php

namespace App\Http\Controllers;

use App\Domain;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DomainsController extends Controller
{

    public function index()
    {

    }

    public function add()
    {
        $whoisApiUrl = getenv('WHOIS_API_URL');
        $whoisApiKey = getenv('WHOIS_API_KEY');
        $domainName = request('domain_name');

        $client = new Client();

        $response = $client->request('GET', $whoisApiUrl, [
            'query' => [
                'apiKey' => $whoisApiKey,
                'domainName' => $domainName,
                'outputFormat' => 'JSON'
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            // @todo - Make sure this gets logged into Sentry
        }



    }

    public function create()
    {
        $domain = new Domain();
        $domain->name = request('name');

    }

}

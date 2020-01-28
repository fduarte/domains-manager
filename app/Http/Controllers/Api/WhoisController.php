<?php

namespace App\Http\Controllers\Api;

use App\Domain;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WhoisController extends Controller
{

    public function getData(Request $request)
    {

        $whoisApiUrl = getenv('WHOIS_API_URL');
        $whoisApiKey = getenv('WHOIS_API_KEY');
        $domainName = $request->domainName;

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
            return 'WHOIS API error.';
        }

        // Save domain's expiresDate
        $res = json_decode($response->getBody()->getContents());

        if (! isset($res->WhoisRecord->expiresDate)) {
            return 'WHOIS Expires Date not available';
        }

        $expiresDate = Carbon::createFromTimeString($res->WhoisRecord->expiresDate)->format('Y-m-d');
        $domain = Domain::where('domain_name', $domainName)
                        ->update(['domain_expires_date' => $expiresDate]);

        // @todo - Monolog INFO

        return $response;
    }
}

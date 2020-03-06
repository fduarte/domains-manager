<?php

namespace App\Http\Controllers\Api;

use App\Domain;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $message = 'WHOIS API error code: ' . $response->getStatusCode();
            Log::error($message);
            return $message;
        }

        // Save domain's expiresDate, createdData
        $res = json_decode($response->getBody()->getContents());

        if (isset($res->WhoisRecord->expiresDate)) {
            $expiresDate = $res->WhoisRecord->expiresDate;
            $createdDate = $res->WhoisRecord->createdDate;

            $expiresDate = Carbon::create($expiresDate)->format('Y-m-d');
            $createdDate = Carbon::create($createdDate)->format('Y-m-d');
        } elseif (isset($res->WhoisRecord->registryData->expiresDate)) {

            // .pt domains
            $expiresDate = $res->WhoisRecord->registryData->expiresDate;
            $createdDate = $res->WhoisRecord->registryData->createdDate;

            $expiresDate = Carbon::createFromFormat('d/m/Y H:i:s', $expiresDate)->format('Y-m-d');
            $createdDate = Carbon::createFromFormat('d/m/Y H:i:s', $createdDate)->format('Y-m-d');
        } else {
            $message = 'WHOIS data not available';
            Log::error($message);
            return $message;
        }

        $adminContactName = $res->WhoisRecord->registryData->administrativeContact->name ?? $res->WhoisRecord->administrativeContact->name ?? NULL;
        $adminContactEmail = $res->WhoisRecord->contactEmail ?? NULL;
        $domainStatus = $res->WhoisRecord->registryData->status ?? $res->WhoisRecord->status ?? NULL;

        $updateData = [
            'domain_expires_date' => $expiresDate,
            'domain_created_date' => $createdDate,
            'domain_status' => $domainStatus,
            'admin_contact_name' => $adminContactName,
            'admin_contact_email' => $adminContactEmail
        ];

        $domain = Domain::where('domain_name', $domainName)
                        ->update($updateData);

        Log::info('WHOIS call successful and domain updated: ' . $domainName);

        return response()->json($updateData);
    }
}

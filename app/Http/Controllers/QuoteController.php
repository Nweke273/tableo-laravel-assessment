<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index()
    {
        return view('quotes.index');
    }

    public function fetchQuotes(Request $request)
    {
        try {
            $quotes = [];

            for ($i = 0; $i < 5; $i++) {
                $response = $this->client->get('https://api.kanye.rest');
                $quote = json_decode($response->getBody()->getContents(), true)['quote'];
                $quotes[] = $quote;
            }
        } catch (\Exception $e) {
            Log::error('Failed to fetch quotes: ' . $e->getMessage());

            $quotes = ['Failed to fetch quotes. Please try again later.'];
        }

        return response()->json($quotes);
    }
}

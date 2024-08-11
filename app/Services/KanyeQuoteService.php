<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KanyeQuoteService
{
    protected $client;
    protected $apiUrl;
    protected $quoteLimit;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = config('app.kanye_quote_url');
        $this->quoteLimit = config('app.kanye_quote_limit');
    }

    public function fetchQuotes()
    {
        $cacheKey = 'kanye_quotes';
        $cacheDuration = now()->addMinutes(10);
        try {
            $quotes = [];
            for ($i = 0; $i < $this->quoteLimit; $i++) {
                $response = $this->client->get($this->apiUrl);
                $quote = json_decode($response->getBody()->getContents(), true)['quote'];
                $quotes[] = $quote;
            }

            Cache::put($cacheKey, $quotes, $cacheDuration);

            return $quotes;
        } catch (\Exception $e) {
            Log::error('Failed to fetch quotes: ' . $e->getMessage());

            $cachedQuotes = Cache::get($cacheKey);

            if ($cachedQuotes) {
                return $cachedQuotes;
            } else {
                return ['Failed to fetch quotes. Please try again later.'];
            }
        }
    }
}

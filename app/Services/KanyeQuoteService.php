<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

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
                $responseData = json_decode($response->getBody()->getContents(), true);

                if (isset($responseData['quote'])) {
                    $quotes[] = $responseData['quote'];
                } else {
                    Log::warning('Quote key not found in API response.');
                    return ['No quotes found.'];
                }
            }

            Cache::put($cacheKey, $quotes, $cacheDuration);

            return $quotes;
        } catch (Exception $e) {
            Log::error('Error ' . $e->getMessage());

            $cachedQuotes = Cache::get($cacheKey);

            if ($cachedQuotes) {
                return $cachedQuotes;
            } else {
                return ['Error: Failed to fetch quotes. Please check your internet connection or try a different network.'];
            }
        }
    }
}

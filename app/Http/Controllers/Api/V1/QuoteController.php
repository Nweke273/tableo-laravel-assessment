<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\KanyeQuoteService;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    public function fetchQuotes(KanyeQuoteService $kanyeQuoteService)
    {
        $quotes = $kanyeQuoteService->fetchQuotes();
        return response()->json($quotes);
    }
}

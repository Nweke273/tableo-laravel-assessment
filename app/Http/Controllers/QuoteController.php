<?php

namespace App\Http\Controllers;
use App\Services\KanyeQuoteService;

class QuoteController extends Controller
{
    public function index()
    {
        return view('quotes.index');
    }

    public function fetchQuotes(KanyeQuoteService $kanyeQuoteService)
    {
        $quotes = $kanyeQuoteService->fetchQuotes();
        return response()->json($quotes);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\KanyeQuoteService;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = (new KanyeQuoteService())->fetchQuotes();
        return view('quotes.index', compact('quotes'));
    }
}

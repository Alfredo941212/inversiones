<?php

namespace App\Http\Controllers;

use App\Services\FinnhubService;
use Illuminate\View\View;
use Throwable;

class QuoteController extends Controller
{
    public function index(
        FinnhubService $finnhubService
    ): View {
        $assets = [
            'AAPL' => 'Apple',
            'MSFT' => 'Microsoft',
            'NVDA' => 'NVIDIA',
            'AMZN' => 'Amazon',
            'TSLA' => 'Tesla',
        ];

        $quotes = [];
        $error = null;

        try {
            $quotes = $finnhubService->getMultipleQuotes(
                array_keys($assets)
            );
        } catch (Throwable $exception) {
            report($exception);

            $error = $exception->getMessage();
        }

        return view('quotes.index', [
            'assets' => $assets,
            'quotes' => $quotes,
            'error' => $error,
        ]);
    }
}
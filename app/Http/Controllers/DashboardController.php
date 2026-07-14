<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
         $userId = (int) Auth::id();
        $transactions = Transaction::query()
            ->where('user_id', $userId)
            ->where('status', 'activa')
            ->with('asset')
            ->get();

        $purchases = (float) $transactions
            ->where('type', 'compra')
            ->sum('total');

        $sales = (float) $transactions
            ->where('type', 'venta')
            ->sum('total');

        $initialBalance = 100000;

        $availableBalance =
            $initialBalance - $purchases + $sales;

        $activeOperations = $transactions->count();

        $portfolio = $transactions
            ->groupBy('asset_id')
            ->map(function ($assetTransactions) {
                $asset = $assetTransactions->first()->asset;

                $purchased = (float) $assetTransactions
                    ->where('type', 'compra')
                    ->sum('quantity');

                $sold = (float) $assetTransactions
                    ->where('type', 'venta')
                    ->sum('quantity');

                $quantity = $purchased - $sold;

                return [
                    'asset' => $asset,
                    'quantity' => $quantity,
                    'estimated_value' =>
                        $quantity * (float) $asset->current_price,
                ];
            })
            ->filter(fn (array $item) => $item['quantity'] > 0);

        $investedCapital = $portfolio->sum('estimated_value');

        return view('dashboard.index', [
            'initialBalance' => $initialBalance,
            'availableBalance' => $availableBalance,
            'investedCapital' => $investedCapital,
            'activeOperations' => $activeOperations,
            'portfolio' => $portfolio,
        ]);
    }
}
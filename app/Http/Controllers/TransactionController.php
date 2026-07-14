<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::query()
            ->where('user_id', (int) Auth::id())
            ->with('asset')
            ->latest('operation_date')
            ->paginate(10);

        return view(
            'transactions.index',
            compact('transactions')
        );
    }

    public function create(): View
    {
        $assets = Asset::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'transactions.create',
            compact('assets')
        );
    }

    public function store(
        StoreTransactionRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        if ($data['type'] === 'venta') {
            $available = $this->availableQuantity(
                (int) Auth::id(),
                (int) $data['asset_id']
            );

            if ((float) $data['quantity'] > $available) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'quantity' =>
                            'No tienes suficientes unidades para vender.',
                    ]);
            }
        }

        DB::transaction(function () use ($data): void {
            Transaction::create([
                'user_id' => (int) Auth::id(),
                'asset_id' => $data['asset_id'],
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'unit_price' => $data['unit_price'],
                'total' => round(
                    (float) $data['quantity']
                    * (float) $data['unit_price'],
                    2
                ),
                'operation_date' => $data['operation_date'],
                'status' => 'activa',
            ]);
        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Operación registrada correctamente.');
    }

    public function edit(Transaction $transaction): View
    {
        $this->ensureOwnership($transaction);

        if ($transaction->status === 'cancelada') {
            abort(403, 'Una operación cancelada no puede editarse.');
        }

        $assets = Asset::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'transactions.edit',
            compact('transaction', 'assets')
        );
    }

    public function update(
        StoreTransactionRequest $request,
        Transaction $transaction
    ): RedirectResponse {
        $this->ensureOwnership($transaction);

        if ($transaction->status === 'cancelada') {
            abort(403, 'Una operación cancelada no puede editarse.');
        }

        $data = $request->validated();

        if ($data['type'] === 'venta') {
            $available = $this->availableQuantity(
                (int) Auth::id(),
                (int) $data['asset_id'],
                $transaction->id
            );

            if ((float) $data['quantity'] > $available) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'quantity' =>
                            'No tienes suficientes unidades para vender.',
                    ]);
            }
        }

        DB::transaction(function () use (
            $transaction,
            $data
        ): void {
            $transaction->update([
                'asset_id' => $data['asset_id'],
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'unit_price' => $data['unit_price'],
                'total' => round(
                    (float) $data['quantity']
                    * (float) $data['unit_price'],
                    2
                ),
                'operation_date' => $data['operation_date'],
            ]);
        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Operación actualizada correctamente.');
    }

    public function destroy(
        Transaction $transaction
    ): RedirectResponse {
        $this->ensureOwnership($transaction);

        $transaction->update([
            'status' => 'cancelada',
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Operación cancelada correctamente.');
    }

    private function ensureOwnership(
        Transaction $transaction
    ): void {
        abort_unless(
            $transaction->user_id === (int) Auth::id(),
            403,
            'No tienes permiso para modificar esta operación.'
        );
    }

    private function availableQuantity(
        int $userId,
        int $assetId,
        ?int $ignoredTransactionId = null
    ): float {
        $query = Transaction::query()
            ->where('user_id', $userId)
            ->where('asset_id', $assetId)
            ->where('status', 'activa');

        if ($ignoredTransactionId !== null) {
            $query->whereKeyNot($ignoredTransactionId);
        }

        $purchases = (clone $query)
            ->where('type', 'compra')
            ->sum('quantity');

        $sales = (clone $query)
            ->where('type', 'venta')
            ->sum('quantity');

        return (float) $purchases - (float) $sales;
    }
}
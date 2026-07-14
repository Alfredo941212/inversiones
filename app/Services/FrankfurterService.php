<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class FrankfurterService
{
    /**
     * Obtiene los tipos de cambio de una moneda base.
     *
     * @param string $base
     * @param array<int, string> $quotes
     * @return array<string, array<string, mixed>>
     */
    public function getRates(
        string $base = 'USD',
        array $quotes = ['MXN', 'EUR', 'GBP']
    ): array {
        $response = Http::baseUrl(
            config('services.frankfurter.base_url')
        )
            ->acceptJson()
            ->timeout(10)
            ->retry(2, 300)
            ->get('/v2/rates', [
                'base' => strtoupper($base),
                'quotes' => implode(
                    ',',
                    array_map('strtoupper', $quotes)
                ),
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'La API de divisas respondió con un error.'
            );
        }

        $rates = $response->json();

        if (! is_array($rates)) {
            throw new RuntimeException(
                'La API devolvió una respuesta no válida.'
            );
        }

        return collect($rates)
            ->filter(function (array $rate): bool {
                return isset(
                    $rate['quote'],
                    $rate['rate']
                );
            })
            ->mapWithKeys(function (array $rate): array {
                return [
                    $rate['quote'] => $rate,
                ];
            })
            ->all();
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class FinnhubService
{
    /**
     * Consulta la cotización de una acción.
     *
     * @return array<string, mixed>
     */
    public function getQuote(string $symbol): array
    {
        $apiKey = config('services.finnhub.key');

        if (empty($apiKey)) {
            throw new RuntimeException(
                'La API key de Finnhub no está configurada.'
            );
        }

        $response = Http::baseUrl(
            config('services.finnhub.base_url')
        )
            ->acceptJson()
            ->timeout(15)
            ->retry(2, 500)
            ->get('/quote', [
                'symbol' => strtoupper($symbol),
                'token' => $apiKey,
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'Finnhub respondió con un error HTTP.'
            );
        }

        $data = $response->json();

        if (
            ! is_array($data)
            || ! isset($data['c'])
        ) {
            throw new RuntimeException(
                'La respuesta de Finnhub no es válida.'
            );
        }

        return $data;
    }

    /**
     * Consulta varias acciones.
     *
     * @param array<int, string> $symbols
     * @return array<string, array<string, mixed>>
     */
    public function getMultipleQuotes(array $symbols): array
    {
        $quotes = [];

        foreach ($symbols as $symbol) {
            $quotes[$symbol] = $this->getQuote($symbol);
        }

        return $quotes;
    }
}
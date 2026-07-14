<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
         return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'asset_id' => [
                'required',
                'exists:assets,id',
            ],
            'type' => [
                'required',
                'in:compra,venta',
            ],
            'quantity' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'unit_price' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'operation_date' => [
                'required',
                'date',
                'before_or_equal:now',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.gt' => 'La cantidad debe ser mayor que cero.',
            'unit_price.gt' => 'El precio debe ser mayor que cero.',
            'operation_date.before_or_equal' =>
                'La operación no puede tener una fecha futura.',
        ];
    }
}
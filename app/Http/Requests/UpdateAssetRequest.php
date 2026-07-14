<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
         return $this->user() !== null;
    }

    public function rules(): array
    {
        $asset = $this->route('asset');

        return [
            'asset_type_id' => [
                'required',
                'exists:asset_types,id',
            ],
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'symbol' => [
                'required',
                'string',
                'max:20',
                Rule::unique('assets', 'symbol')
                    ->ignore($asset?->id),
            ],
            'api_id' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('assets', 'api_id')
                    ->ignore($asset?->id),
            ],
            'current_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'symbol' => strtoupper((string) $this->symbol),
            'api_id' => $this->api_id
                ? strtolower(trim((string) $this->api_id))
                : null,
        ]);
    }
}
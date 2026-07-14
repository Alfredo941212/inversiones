<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
         return $this->user() !== null;
    }

    public function rules(): array
    {
        $assetType = $this->route('asset_type');

        return [
            'name' => [
                'required',
                'string',
                'max:80',
                Rule::unique('asset_types', 'name')
                    ->ignore($assetType?->id),
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
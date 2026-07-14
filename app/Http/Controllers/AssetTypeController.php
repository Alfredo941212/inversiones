<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetTypeRequest;
use App\Http\Requests\UpdateAssetTypeRequest;
use App\Models\AssetType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssetTypeController extends Controller
{
    public function index(): View
    {
        $assetTypes = AssetType::query()
            ->withCount('assets')
            ->orderBy('name')
            ->paginate(10);

        return view('asset-types.index', compact('assetTypes'));
    }

    public function create(): View
    {
        return view('asset-types.create');
    }

    public function store(
        StoreAssetTypeRequest $request
    ): RedirectResponse {
        AssetType::create($request->validated());

        return redirect()
            ->route('asset-types.index')
            ->with('success', 'Tipo de activo registrado correctamente.');
    }

    public function edit(AssetType $assetType): View
    {
        return view('asset-types.edit', compact('assetType'));
    }

    public function update(
        UpdateAssetTypeRequest $request,
        AssetType $assetType
    ): RedirectResponse {
        $assetType->update($request->validated());

        return redirect()
            ->route('asset-types.index')
            ->with('success', 'Tipo de activo actualizado correctamente.');
    }

    public function destroy(
        AssetType $assetType
    ): RedirectResponse {
        if ($assetType->assets()->exists()) {
            return back()->with(
                'error',
                'No se puede eliminar porque tiene activos relacionados.'
            );
        }

        $assetType->delete();

        return redirect()
            ->route('asset-types.index')
            ->with('success', 'Tipo de activo eliminado correctamente.');
    }
}
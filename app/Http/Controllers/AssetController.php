<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Models\AssetType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssetController extends Controller
{
    public function index(): View
    {
        $assets = Asset::query()
            ->with('assetType')
            ->orderBy('name')
            ->paginate(10);

        return view('assets.index', compact('assets'));
    }

    public function create(): View
    {
        $assetTypes = AssetType::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('assets.create', compact('assetTypes'));
    }

    public function store(
        StoreAssetRequest $request
    ): RedirectResponse {
        Asset::create($request->validated());

        return redirect()
            ->route('assets.index')
            ->with('success', 'Activo registrado correctamente.');
    }

    public function edit(Asset $asset): View
    {
        $assetTypes = AssetType::query()
            ->orderBy('name')
            ->get();

        return view(
            'assets.edit',
            compact('asset', 'assetTypes')
        );
    }

    public function update(
        UpdateAssetRequest $request,
        Asset $asset
    ): RedirectResponse {
        $asset->update($request->validated());

        return redirect()
            ->route('assets.index')
            ->with('success', 'Activo actualizado correctamente.');
    }

    public function destroy(Asset $asset): RedirectResponse
    {
        if ($asset->transactions()->exists()) {
            return back()->with(
                'error',
                'No se puede eliminar porque tiene operaciones relacionadas.'
            );
        }

        $asset->delete();

        return redirect()
            ->route('assets.index')
            ->with('success', 'Activo eliminado correctamente.');
    }
}
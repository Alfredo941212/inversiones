<div class="mb-3">
    <label class="form-label">
        Tipo de activo
    </label>

    <select
        name="asset_type_id"
        class="form-select"
        required
    >
        <option value="">
            Selecciona una opción
        </option>

        @foreach ($assetTypes as $type)
            <option
                value="{{ $type->id }}"
                @selected(old(
                    'asset_type_id',
                    $asset->asset_type_id ?? ''
                ) == $type->id)
            >
                {{ $type->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            Nombre
        </label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $asset->name ?? '') }}"
            required
        >
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Símbolo
        </label>

        <input
            type="text"
            name="symbol"
            class="form-control"
            value="{{ old('symbol', $asset->symbol ?? '') }}"
            required
        >
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            ID de CoinGecko
        </label>

        <input
            type="text"
            name="api_id"
            class="form-control"
            value="{{ old('api_id', $asset->api_id ?? '') }}"
            placeholder="Ejemplo: bitcoin"
        >
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Precio actual
        </label>

        <input
            type="number"
            name="current_price"
            class="form-control"
            step="0.01"
            min="0"
            value="{{ old(
                'current_price',
                $asset->current_price ?? 0
            ) }}"
            required
        >
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Estado</label>

    <select
        name="is_active"
        class="form-select"
        required
    >
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
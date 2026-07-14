<div class="mb-3">
    <label class="form-label">Activo</label>

    <select
        name="asset_id"
        class="form-select"
        required
    >
        <option value="">Selecciona un activo</option>

        @foreach ($assets as $asset)
            <option
                value="{{ $asset->id }}"
                @selected(old(
                    'asset_id',
                    $transaction->asset_id ?? ''
                ) == $asset->id)
            >
                {{ $asset->name }} ({{ $asset->symbol }})
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            Tipo de operación
        </label>

        <select
            name="type"
            class="form-select"
            required
        >
            <option
                value="compra"
                @selected(old(
                    'type',
                    $transaction->type ?? ''
                ) === 'compra')
            >
                Compra
            </option>

            <option
                value="venta"
                @selected(old(
                    'type',
                    $transaction->type ?? ''
                ) === 'venta')
            >
                Venta
            </option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Cantidad
        </label>

        <input
            type="number"
            name="quantity"
            class="form-control"
            step="0.00000001"
            min="0.00000001"
            value="{{ old(
                'quantity',
                $transaction->quantity ?? ''
            ) }}"
            required
        >
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            Precio unitario
        </label>

        <input
            type="number"
            name="unit_price"
            class="form-control"
            step="0.01"
            min="0.01"
            value="{{ old(
                'unit_price',
                $transaction->unit_price ?? ''
            ) }}"
            required
        >
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Fecha de operación
        </label>

        <input
            type="datetime-local"
            name="operation_date"
            class="form-control"
            value="{{ old(
                'operation_date',
                isset($transaction)
                    ? $transaction->operation_date->format('Y-m-d\TH:i')
                    : now()->format('Y-m-d\TH:i')
            ) }}"
            required
        >
    </div>
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
<div class="mb-3">
    <label class="form-label">
        Nombre
    </label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $assetType->name ?? '') }}"
        required
    >

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Descripción
    </label>

    <textarea
        name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="3"
    >{{ old('description', $assetType->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Estado
    </label>

    <select
        name="is_active"
        class="form-select"
        required
    >
        <option
            value="1"
            @selected(old(
                'is_active',
                isset($assetType) ? $assetType->is_active : 1
            ) == 1)
        >
            Activo
        </option>

        <option
            value="0"
            @selected(old(
                'is_active',
                isset($assetType) ? $assetType->is_active : 1
            ) == 0)
        >
            Inactivo
        </option>
    </select>
</div>
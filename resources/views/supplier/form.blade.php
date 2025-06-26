<form method="POST" action="{{ isset($supplier) ? route('supplier.update', $supplier) : route('supplier.store') }}">
    @csrf
    @if (isset($supplier))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Supplier</label>
        <input type="text" name="nama" id="nama" class="form-control bg-light border rounded px-3 py-2"
            value="{{ old('nama', $supplier->nama ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" class="form-control bg-light border rounded px-3 py-2">{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="telepon" class="form-label">No. Telepon</label>
        <input type="text" name="telepon" id="telepon" class="form-control bg-light border rounded px-3 py-2"
            value="{{ old('telepon', $supplier->telepon ?? '') }}">
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded align-middle me-1">save</span>
            {{ isset($supplier) ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>

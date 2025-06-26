<div class="mb-3">
    <label for="nama" class="form-label">Nama Kategori</label>
    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $kategori->nama ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <textarea id="keterangan" name="keterangan" class="form-control" rows="3">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
</div>

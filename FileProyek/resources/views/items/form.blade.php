@extends('layouts.app')
@section('title', $item->exists ? 'Edit Barang' : 'Tambah Barang')

@section('content')
<div class="card" style="max-width:700px;">
    <div class="card-header">
        <h2><i class="ri-archive-2-fill"></i> {{ $item->exists ? 'Edit Barang' : 'Tambah Barang Baru' }}</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $item->exists ? route('items.update', $item) : route('items.store') }}" enctype="multipart/form-data">
            @csrf
            @if($item->exists) @method('PUT') @endif

            <div class="form-group">
                <label class="form-label">Nama Barang *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" class="form-control" value="{{ old('sku', $item->sku) }}" placeholder="BT-010">
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Jual *</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $item->price) }}" required min="0">
                </div>
            </div>

            @if(auth()->user()->isMaster())
            <div class="form-group">
                <label class="form-label">Harga Beli * <small>(Hanya Master yang bisa melihat & mengisi)</small></label>
                <input type="number" name="purchase_price" class="form-control" value="{{ old('purchase_price', $item->purchase_price) }}" required min="0" style="border-color: var(--accent);">
            </div>
            @else
            <input type="hidden" name="purchase_price" value="{{ $item->purchase_price ?? 0 }}">
            @endif

            <div class="form-group">
                <label class="form-label">Stok *</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $item->stock) }}" required min="0">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Rak Utama (Primary)</label>
                    <input type="text" name="rack_primary" class="form-control" value="{{ old('rack_primary', $item->rack_primary) }}" placeholder="A-01">
                </div>
                <div class="form-group">
                    <label class="form-label">Rak Cadangan (Secondary)</label>
                    <input type="text" name="rack_secondary" class="form-control" value="{{ old('rack_secondary', $item->rack_secondary) }}" placeholder="B-03">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $item->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="item-image">Foto Barang (JPG, PNG, atau WebP, maks 5MB)</label>
                <input type="file" name="image" id="item-image" class="form-control" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <div class="image-upload-preview" id="image-preview" @if(!$item->image) style="display:none;" @endif>
                    <img id="image-preview-img" src="{{ $item->image ? asset('storage/' . $item->image) : '' }}" alt="Preview foto barang">
                </div>
                @if($item->image)
                <small style="color:var(--text-muted);">Foto saat ini. Pilih foto baru untuk menggantinya.</small>
                @endif
            </div>

            <div class="flex gap-1 mt-2">
                <button type="submit" class="btn btn-primary"><i class="ri-save-fill"></i> Simpan</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const imageInput = document.getElementById('item-image');
    const imagePreview = document.getElementById('image-preview');
    const imagePreviewImg = document.getElementById('image-preview-img');
    let previewUrl = null;

    imageInput.addEventListener('change', () => {
        const [file] = imageInput.files;
        if (!file) return;

        if (previewUrl) URL.revokeObjectURL(previewUrl);
        previewUrl = URL.createObjectURL(file);
        imagePreviewImg.src = previewUrl;
        imagePreview.style.display = 'block';
    });
</script>
@endpush

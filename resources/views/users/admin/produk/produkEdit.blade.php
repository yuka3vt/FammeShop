@extends('users.admin.index')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <form action="/admin/produk-edit/{{ $produk->slug }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="foto" class="col-form-label font">Foto Produk</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input font" name="image" id="customFileLangHTML" onchange="updateFileName(this)">
                            <label class="custom-file-label font" for="customFileLangHTML" data-browse="Choose">Choose file...</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Produk" autofocus required value="{{ $produk->nama }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" required value="{{ number_format($produk->harga, 0, ',', '.') }}" oninput="formatHarga(this)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Slug">Slug</label>
                        <input type="text" name="Slug" class="form-control" id="slug" readonly required value="{{ $produk->slug }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" class="form-control" id="stok" min="1" required value="{{ $produk->stok }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori[]" multiple required>
                            @foreach ($produkKategori as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <select class="form-control" id="warna" name="warna[]" multiple required>
                            @foreach ($produkWarna as $warna)
                                <option value="{{ $warna->id }}" {{ in_array($warna->id, $selectedWarnas) ? 'selected' : '' }}>{{ $warna->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <select class="form-control" id="ukuran" name="ukuran[]" multiple required>
                            @foreach ($produkUkuran as $ukuran)
                                <option value="{{ $ukuran->id }}" {{ in_array($ukuran->id, $selectedUkurans) ? 'selected' : '' }}>{{ $ukuran->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bahan">Bahan</label>
                        <input type="text" name="bahan" class="form-control" id="bahan" placeholder="Bahan Produk" value="{{ $produk->bahan }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="dimensi">Dimensi</label>
                        <input type="text" name="dimensi" class="form-control" id="dimensi" value="{{ $produk->dimensi }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <input type="number" name="berat" class="form-control" id="berat" min="0" value="{{ $produk->berat }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control deskripsi" id="deskripsi" name="deskripsi" rows="6">{!! $produk->deskripsi !!}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

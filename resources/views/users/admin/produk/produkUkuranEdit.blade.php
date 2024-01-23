@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Ukuran</h6>
            </div>
            <div class="card-body">
                <form action="/admin/produk-ukuran-edit/{{ $produkUkuran->slug }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input value="{{ $produkUkuran->nama }}" autofocus type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug:</label>
                        <input value="{{ $produkUkuran->slug }}" type="text" class="form-control" name="slug" id="slug" placeholder="Slug Kategori" readonly required>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

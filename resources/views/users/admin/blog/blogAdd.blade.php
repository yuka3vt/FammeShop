@extends('users.admin.index')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <form action="/admin/blog-tambah" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="foto" class="col-form-label font">Foto Blog</label>
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
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="nama" placeholder="Judul blog" autofocus required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Slug">Slug</label>
                        <input type="text" name="Slug" class="form-control" id="slug" readonly required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori[]" multiple required>
                            @foreach ($blogKategori as $category)
                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea class="form-control konten" id="konten" name="isi_blog" rows="6"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Blog</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr  class="stext-110-b">
                        <th>No</th>
                        <th>Image</th>
                        <th>Judul Blog</th>
                        <th>Pembuat</th>
                        <th>Kategori</th>
                        <th>Excerpt</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blog as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->image ==="default")
                                <img src="{{ asset('defaultBlog.png') }}" alt="IMG" class="image-blog">
                            @else
                                <img src="{{ asset('storage/'.$item->image) }}" alt="IMG" class="image-blog">
                            @endif
                        </td>
                        <td>
                            <a class="hover-none stext-110-b text-abu" href="/blog/{{ $item->slug }}">{{ $item->judul }}</a>
                        </td>
                        <td class="stext-110">{{ $item->user->nama }}</td>
                        <td class="stext-110">
                            @foreach ($item->blogkategori as $key => $blogkategori)
                                {{ $blogkategori->nama }}
                                @if ($key < count($item->blogkategori) - 1)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td class="stext-110">
                            {{ $item->kutipan }} 
                            <a class="hover-none stext-110" href="/blog/{{ $item->slug }}"><span class="stext-110-b text-abu">read more...</span></a>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-between align-items-center">
                                    <a href="/admin/blog-edit/{{ $item->slug }}"" class="btn btn-primary btn-circle"><i class="fa fa-pencil-square-o"></i></a>
                                    <form action="/admin/blog-hapus" method="POST">
                                        @csrf
                                        <input type="hidden" name="ID" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger btn-circle"
                                            onclick="return confirm('Yakin ingin menghapus')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

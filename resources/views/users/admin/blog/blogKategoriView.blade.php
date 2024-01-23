@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kategori Blog</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr  class="stext-110-b">
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogKategori as $item)
                    <tr  class="stext-110">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-between align-items-center">
                                    <a href="/admin/blog-kategori-edit/{{ $item->slug }}"" class="btn btn-primary btn-circle"><i class="fa fa-pencil-square-o"></i></a>
                                    <form action="/admin/blog-kategori-hapus" method="POST">
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

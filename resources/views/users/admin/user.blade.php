@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr  class="stext-110-b">
                        <th>No</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataUser as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->image ==="default")
                                <img src="{{ asset('defaultUser.png') }}" alt="IMG" class="image-produk">
                            @else
                                <img src="{{ asset('storage/'.$item->image) }}" alt="IMG" class="image-produk">
                            @endif
                        </td>
                        <td class="stext-110">{{ $item->username }}</td>
                        <td class="stext-110">{{ $item->nama }}</td>
                        <td class="stext-110">{{ $item->jenis_kelamin }}</td>
                        <td class="stext-110">{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</td>
                        <td class="stext-110">{{ $item->telepon }}</td>
                        <td class="stext-110">{{ $item->email }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-between align-items-center">
                                    <form action="/admin/hapus-user/{{ $item->username }}" method="POST">
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

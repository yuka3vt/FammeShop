@extends('users.admin.index')
@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered min400" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="stext-110-b">
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Variasi</th>
                        <th>Detail</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Diskon</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($item->image ==="default")
                                    <img src="{{ asset('defaultProduk.png') }}" alt="IMG" class="image-produk">
                                    @else
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="IMG" class="image-produk">
                                    @endif
                                </div>
                                <div class="col-md-12 stext-110">
                                    {{ $item->nama }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="stext-110">
                                @foreach ($item->produkkategori as $key => $produkkategori)
                                {{ $produkkategori->nama }}
                                @if ($key < count($item->produkkategori) - 1)
                                    ,
                                    @endif
                                    @endforeach
                            </span>
                        </td>
                        <td class="min80">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="stext-110-b">Warna :</span>
                                    <span class="stext-110">
                                        @foreach ($item->produkwarna as $key => $produkwarna)
                                        {{ $produkwarna->nama }}
                                        @if ($key < count($item->produkwarna) - 1)
                                            ,
                                            @endif
                                            @endforeach
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <span class="stext-110-b">Ukuran :</span>
                                    <span class="stext-110">
                                        @foreach ($item->produkukuran as $key => $produkukuran)
                                        {{ $produkukuran->nama }}
                                        @if ($key < count($item->produkukuran) - 1)
                                            ,
                                            @endif
                                            @endforeach
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="min80">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="stext-110-b">Bahan :</span>
                                    @if ($item->bahan ==null)
                                    <span class="stext-110-b">-</span>
                                    @else
                                    <span class="stext-110">
                                        {{ $item->bahan }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <span class="stext-110-b">Berat :</span>
                                    @if ($item->berat ==null)
                                    <span class="stext-110-b">-</span>
                                    @else
                                    <span class="stext-110">
                                        {{ $item->berat }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <span class="stext-110-b">Dimensi :</span>
                                    @if ($item->dimensi == null)
                                    <span class="stext-110-b">-</span>
                                    @else
                                    <span class="stext-110">
                                        {{ $item->dimensi }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="stext-110">{!! $item->deskripsi !!}</span>
                        </td>
                        <td>
                            <span class="stext-110">{{ $item->stok }}</span>
                        </td>
                        <td>
                            <span class="stext-110">{{ $item->diskon }} %</span>
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                data-target="#diskonModal{{ $item->id }}">+</button>
                            <!-- Modal -->
                            <form method="POST" action="/admin/tambah-diskon" class="modal fade" id="diskonModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                @csrf
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Diskon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    Produk
                                                </div>
                                                <div class="col-md-10">
                                                    {{ $item->nama }}
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="judul">Diskon</label>
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input type="hidden" name="idProduk"
                                                                    value="{{ $item->id }}">
                                                                <input type="number" name="diskon" class="form-control"
                                                                    id="nama" min="0" max="100" required>
                                                            </div>
                                                            <div
                                                                class="col-md-2 d-flex align-items-center justify-content-start">
                                                                %
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="min80">
                            
                            <span class="stext-110">
                                @if ($item->diskon !== null)
                                <span class="stext-110-b">Rp.</span>
                                <span class="strikethrough">
                                    {{ number_format($item->harga, 0, ',', '.') }}
                                </span> &nbsp;<p><span class="stext-110-b">Rp.</span> {{ number_format($item->hargaTotal, 0, ',', '.') }}</p>
                                @else
                                <span class="stext-110-b">Rp.</span>
                                {{ number_format($item->harga, 0, ',', '.') }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-between align-items-center">
                                    <a href="/admin/produk-edit/{{ $item->slug }}"" class=" btn btn-primary
                                        btn-circle"><i class="fa fa-pencil-square-o"></i></a>
                                    <form action="/admin/produk-hapus" method="POST">
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

@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
        <div class="row">
            @php
            $status = strtolower(request()->query('status'));
            @endphp
            <div class="col-md-12 d-flex justify-content-center">
                <a href="/admin/pesanan" class="stext-111-b {{ $status === 'bayar' ? 'aktif' : '' }}">Pesanan</a>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <a href="/admin/pesanan?status=dikemas"
                    class="stext-111-b {{ $status === 'dikemas' ? 'aktif' : '' }}">Pesanan</a>
            </div>
            <div class="mt-2 col-md-12 d-flex justify-content-center">
                <a href="/admin/pesanan?status=dikirim"
                    class="stext-111-b mr-2 {{ $status === 'dikirim' ? 'aktif' : '' }}">Dikirim</a>
            </div>
            <div class="mt-2 col-md-12 d-flex justify-content-center">
                <a href="/admin/pesanan?status=selesai"
                    class="stext-111-b {{ $status === 'selesai' ? 'aktif' : '' }}">Selesai</a>
            </div>
            <div class="mt-2 col-md-12 d-flex justify-content-center">
                <a href="/admin/pesanan?status=dibatalkan"
                    class="stext-111-b {{ $status === 'dibatalkan' ? 'aktif' : '' }}">Dibatalkan</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered min300" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="stext-110-b">No Pesanan</th>
                        <th class="stext-110-b">Username</th>
                        <th class="min150 stext-110-b">Pesanan</th>
                        <th class="min80 stext-110-b">Alamat</th>
                        <th class="stext-110-b">Metode</th>
                        <th class="stext-110-b">Total</th>
                        <th class="stext-110-b">Status</th>
                        @if ($status==='dikemas' || $status==='dikirim' || $status==='bayar')
                        <th class="stext-110-b">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPesanan as $item)
                    <tr>
                        <td><span class="stext-110">{{ $item->no_pesanan }}</span></td>
                        <td><span class="stext-110">{{ $item->user->username }}</span></td>
                        <td class="min150">
                            @foreach ($item->keranjang as $pesananItems)
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="stext-110-b">{{ $loop->iteration }}.</span>
                                </div>
                                <div class="col-md-10">
                                    <span class="stext-110">{{ $pesananItems->produk->nama }}</span>
                                    <p class="stext-110">Variasi: {{ $pesananItems->warna }},
                                        {{ $pesananItems->ukuran }} x {{ $pesananItems->jumlah }}</p>
                                </div>
                            </div>
                            @endforeach
                        </td>
                        <td class="min80">
                            <p class="stext-110 mb-0">{{ $item->user->nama }}</p>
                            <p class="stext-110 mb-1">{{ $item->user->telepon }}</p>
                            <p class="stext-110">{{ $item->alamat }}</p>
                        </td>
                        <td class="stext-110-b">{{ $item->pembayaran }}</td>
                        <td class="stext-110-b">Rp.{{ number_format($item->subtotal, 0, ',', '.')}}</td>
                        <td class="stext-110-b">
                            @if ($status!=='bayar')
                                {{ $item->status }}
                            @else
                                Perlu dicek
                            @endif
                        </td>
                        @if ($item->keranjang[0]->status==='bayar')
                        <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#cekbayar{{ $item->no_pesanan }}">Cek</button>
                        </td>
                        <div class="modal fade" id="cekbayar{{ $item->no_pesanan }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/cek-bukti-bayar/{{ $item->no_pesanan }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="imagePreview" id="imagePreviewLabel">
                                                <img id="imagePreview" src="{{ asset('storage/'.$item->image) }}"
                                                    alt="IMG" style="width:300px;height:300px;object-fit:cover">
                                            </label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <a href="/batalkan-pesanan/{{ $item->no_pesanan }}" class="btn btn-danger">Tolak</a>
                                            <button type="submit" class="btn btn-success">Terima</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($status==='dikemas')
                        <td>
                            <form method="POST" action="/kirim-pesanan/{{ $item->no_pesanan }}"
                                class="d-flex justify-content-center">
                                @csrf
                                <button class="btn btn-primary stext-110-b">Kirim</button>
                            </form>
                            <form method="POST" action="/batalkan-pesanan/{{ $item->no_pesanan }}"
                                class="d-flex justify-content-center mt-2">
                                @csrf
                                <button class="btn btn-danger stext-110-b">Batal</button>
                            </form>
                        </td>
                        @endif
                        @if ($status==='dikirim')
                        <td>
                            <form method="POST" action="/selesaikan-pesanan/{{ $item->no_pesanan }}"
                                class="d-flex justify-content-center">
                                @csrf
                                <button class="btn btn-success stext-110-b">Selesai</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@extends('users.user.index')
@section('konten')
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg m-b-50">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <a href="#" onclick="goBack()" class="stext-109 cl8 hov-cl1 trans-04">
            Pesanan Saya
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            {{ $detailPesanan->no_pesanan }}
        </span>
    </div>
</div>
<!-- Shoping Cart -->
<div class="bg0 wishMin">
    <div class="container">
        <div class="row p-l-25 p-lr-0-lg">
            <table class="m-l-15 m-b-30">
                <tbody>
                    <td class="text-14-bold p-r-10 p-b-5">Metode</td>
                    <td class="text-14 p-b-5">: {{ $detailPesanan->pembayaran }} <SMall>(7925488453 - Yuka Wardana)</SMall></td>
                </tbody>
                <tbody>
                    <td class="text-14-bold p-r-10 p-b-5">No. Pesanan</td>
                    <td class="text-14 p-b-5">: {{ $detailPesanan->no_pesanan }}</td>
                </tbody>
                <tbody>
                    <td class="text-14-bold p-b-5 p-r-10">Tanggal Pesan</td>
                    <td class="text-14 p-b-15">: {{ $detailPesanan->created_at_formatted }}</td>
                </tbody>
                <tbody>
                    <td class="text-14-bold p-b-20 p-r-10">Status bayar</td>
                    <td class="text-14 p-b-15">: Belum dibayar &nbsp;&nbsp;&nbsp;
                        @if ($detailPesanan->keranjang[0]->status==='bayar')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#bayar">Upload</button>
                        @endif
                    </td>
                </tbody>
                <tbody>
                    <td class="text-14-bold p-r-10"><i class="fa fa-map-marker " aria-hidden="true"></i>&nbsp; Alamat
                        Pengiriman</td>
                    <td class="text-14 ">: {{ $detailPesanan->alamat }}</td>
                </tbody>
            </table>
            <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="/upload-bukti-bayar/{{ $detailPesanan->no_pesanan }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="imagePreview" id="imagePreviewLabel">
                                @if ($detailPesanan->image !== null)
                                    <img id="imagePreview" src="{{ asset('storage/'.$detailPesanan->image) }}" alt="IMG" style="width:300px;height:300px;object-fit:cover">
                                @else
                                    <img id="imagePreview" src="#" alt="IMG" style="width:300px;height:300px;object-fit:cover; display:none;">
                                @endif
                            </label>
                            <input class="mt-2" type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage()">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-10 col-xl-12 m-b-40">
                <div class="m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            @foreach ($detailPesanan->keranjang as $pesananItems)
                            <tr class="table_row">
                                <td class="column-11 p-l-20">
                                    @if ($pesananItems->produk->image==="default")
                                    <img src="{{ asset('defaultProduk.png') }}" alt="IMG"
                                        style="width:60px;height:80px;object-fit:cover">
                                    @else
                                    <img src="{{ asset('storage/'.$pesananItems->produk->image) }}" alt="IMG"
                                        style="width:60px;height:80px;object-fit:cover">
                                    @endif
                                </td>
                                <td class="column-22">
                                    <h6>{{ $pesananItems->produk->nama }}</h6>
                                    <p class="pilihanBarang">{{ $pesananItems->warna }}, {{ $pesananItems->ukuran }}</p>
                                </td>
                                <td class="column-33 p-r-20">
                                    <p class="BanyakBarangdanHarga"><span>{{ $pesananItems->jumlah }} X</span>
                                        @if ($pesananItems->produk->diskon !== null)
                                        Rp. <span class="strikethrough">
                                            {{ number_format($pesananItems->produk->harga, 0, ',', '.') }}
                                        </span>
                                        &nbsp;<span>{{ number_format($pesananItems->produk->hargaTotal, 0, ',', '.') }}</span>
                                        @else
                                        Rp. {{ number_format($pesananItems->produk->harga, 0, ',', '.') }}
                                        @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <table class="table-shopping-cart1 m-t-0">
                            <tr>
                                <td class="column-22 p-l-20 p-t-5 p-b-5">
                                    Subtotal Produk
                                </td>
                                <td class="column-11">
                                </td>
                                <td class="column-33 p-r-20">
                                    Rp. {{ number_format($detailPesanan->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="column-22 p-l-20 p-b-5">
                                    Pengiriman
                                </td>
                                <td class="column-11">
                                </td>
                                <td class="column-33 p-r-20">
                                    Rp. 0
                                </td>
                            </tr>
                            <tr class="row-tr">
                                <td class="column-22 p-l-20 p-b-5">
                                    Total Pesanan
                                </td>
                                <td class="column-11">
                                </td>
                                <td class="column-33 p-r-20">
                                    Rp. {{ number_format($detailPesanan->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    @if ($detailPesanan->keranjang[0]->status === 'dikemas')
                    <form method="POST" action="/batalkan-pesanan/{{ $detailPesanan->no_pesanan }}"
                        class="tx-center m-t-30 stext-106">
                        @csrf
                        <button type="submit"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn31 p-lr-15 trans-04 pointer">
                            Batalkan Pesanan
                        </button>
                    </form>
                    @endif
                    @if ($detailPesanan->keranjang[0]->status === 'dikirim')
                    <form method="POST" action="/selesaikan-pesanan/{{ $detailPesanan->no_pesanan }}"
                        class="tx-center m-t-30 stext-106">
                        @csrf
                        <button type="submit"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn32 p-lr-15 trans-04 pointer">
                            Pesanan di Terima
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        var imageInput = document.getElementById('imageInput');
        var imagePreview = document.getElementById('imagePreview');
        var imagePreviewLabel = document.getElementById('imagePreviewLabel');

        var file = imageInput.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                imagePreviewLabel.style.border = 'none';
            }

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            imagePreviewLabel.style.border = '1px solid #ced4da';
        }
    }
</script>
@endsection

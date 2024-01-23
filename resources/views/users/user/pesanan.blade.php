@extends('users.user.index')
@section('konten')
	<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg m-b-50">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            Pesanan Saya
        </span>
    </div>
</div>
<div class="m-b-30 header-pesanan">
    <div class="filter-tope-group tx-center"> 
        @php
            $status = strtolower(request()->query('status'));
        @endphp
        <a href="/pesanan/{{ auth()->user()->username }}" class="stext-1061 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $status === 'bayar' ? 'how-active1' : '' }}">
            Bayar
        </a>
        <a href="/pesanan/{{ auth()->user()->username }}?status=dikemas" class="stext-1061 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $status === 'dikemas' ? 'how-active1' : '' }}">
            Dikemas
        </a>
        <a href="/pesanan/{{ auth()->user()->username }}?status=dikirim" class="stext-1061 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $status === 'dikirim' ? 'how-active1' : '' }}">
            Dikirim
        </a>
        <a href="/pesanan/{{ auth()->user()->username }}?status=selesai" class="stext-1061 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $status === 'selesai' ? 'how-active1' : '' }}">
            Selesai
        </a>
        <a href="/pesanan/{{ auth()->user()->username }}?status=dibatalkan" class="stext-1061 cl6 hov1 bor3 trans-04 m-tb-5 {{ $status === 'dibatalkan' ? 'how-active1' : '' }}">
            Dibatalkan
        </a>
    </div>
</div>
<!-- Shoping Cart -->
<div class="bg0 wishMin">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-12 m-b-40">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            @if ($dataPesanan->count())
                                @foreach ($dataPesanan as $pesananItems)
                                    <tr class="table_row">
                                        <td class="column-11 p-l-20">
                                            @if ($pesananItems->Keranjang[0]->produk->image==="default")
                                                <img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
                                            @else
                                                <img src="{{ asset('storage/'.$pesananItems->Keranjang[0]->produk->image) }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
                                            @endif
                                        </td>
                                        <td class="column-22">
                                            <h6>{{ $pesananItems->Keranjang[0]->produk->nama }}</h6>
                                            <p class="pilihanBarang">{{ $pesananItems->Keranjang[0]->warna }}, {{ $pesananItems->Keranjang[0]->ukuran }}</p>
                                        </td>
                                        <td class="column-33 p-r-20">
                                            <p class="BanyakBarangdanHarga"><span>{{ $pesananItems->Keranjang[0]->jumlah }} X</span>
                                                @if ($pesananItems->Keranjang[0]->produk->diskon !== 0)
                                                Rp. <span class="strikethrough">
                                                    {{ number_format($pesananItems->Keranjang[0]->produk->harga, 0, ',', '.') }}
                                                </span> &nbsp;<span>{{ number_format($pesananItems->Keranjang[0]->produk->hargaTotal, 0, ',', '.') }}</span>
                                                @else
                                                    Rp. {{ number_format($pesananItems->Keranjang[0]->produk->harga, 0, ',', '.') }}
                                                @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="column-11 p-l-20 p-b-10 p-t-10"></td>
                                        <td class="column-22 p-b-10 p-t-10"><a href="/pesanan/{{ auth()->user()->username }}/{{ $pesananItems->no_pesanan }}" class="tampilLebih">Tampilkan lebih</a></td>
                                        <td class="column-33 p-r-20 p-b-10 p-t-10">
                                            <p class="total">Rp. {{ number_format($pesananItems->subtotal, 0, ',', '.') }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                         </table>
                            @else
                         </table>
                                <h5 class="p-t-15 ltext-20 cl2 trans-04 txt-center">
                                    Kosong
                                </h5>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
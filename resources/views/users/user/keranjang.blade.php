@extends('users.user.index')
@section('konten')
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            Keranjang Saya
        </span>
    </div>
</div>
<div class="bg0 wishMin">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-12 m-b-50">
                <form method="POST" action="/action-keranjang">
                @csrf
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="flex-w p-b-10 right-item ">
                        <button type="submit" name="hapus" class="stext-101 cl2 size-cy bg8 bor13C1 hov-btn3C trans-04 m-tb-10 disabled-button @if ($dataKeranjang->isEmpty()) disabled-button @endif" id="hapus-button">
                            Hapus
                        </button>
                        <button id="update-button" type="submit" name="update" class="stext-101 cl2 size-cy bg8 bor13C2 hov-btn3 trans-04 m-tb-10 disabled-button" disabled>
                            Update
                        </button>
                    </div>
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-ceklist">
                                    <input type="checkbox" id="ceklist-semua" @if ($dataKeranjang->isEmpty()) disabled @endif>
                                </th>
                                <th class="column-1">Produk</th>
                                <th class="column-2"></th>
                                <th class="column-3">Size</th>
                                <th class="column-4">Warna</th>
                                <th class="column-5">Harga</th>
                                <th class="column-6">Jumlah</th>
                                <th class="column-7">Total</th>
                            </tr>
                            @if ($dataKeranjang->count())
                                @foreach ($dataKeranjang as $keranjangItems)
                                    <tr class="table_row">
                                        <td class="column-ceklist">
                                            <input class="item-ceklist" type="checkbox" name="keranjangId[]" value="{{ $keranjangItems->id }}">
                                            <input type="hidden" name="keranjangIdUpdate[]" value="{{ $keranjangItems->id }}">
                                        </td>
                                        <td class="column-1">
                                            @if ($keranjangItems->produk->image ==="default")
                                                <img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
                                            @else
                                                <img src="{{ asset('storage/'.$keranjangItems->produk->image) }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
                                            @endif
                                        </td>
                                        <td class="column-2">{{ $keranjangItems->produk->nama }}</td>
                                        <td class="column-3">{{ $keranjangItems->ukuran }}</td>
                                        <td class="column-4">{{ $keranjangItems->warna }}</td>
                                        <td class="column-5">
                                            @if ($keranjangItems->produk->diskon !== null)
                                            Rp. <span class="strikethrough">
                                                {{ number_format($keranjangItems->produk->harga, 0, ',', '.') }}
                                            </span> &nbsp;<span>{{ number_format($keranjangItems->produk->hargaTotal, 0, ',', '.') }}</span>
                                            @else
                                                Rp. {{ number_format($keranjangItems->produk->harga, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td class="column-6">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <button type="button" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </button>
                                                <input id="num-product-input" class="mtext-104 cl3 txt-center num-product" type="number" min="1" max="{{ $keranjangItems->produk->stok }}" name="num-product1[{{ $keranjangItems->id }}]" value="{{ $keranjangItems->jumlah }}" data-original-value="{{ $keranjangItems->jumlah }}">
                                                <button type="button" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="column-7">Rp. {{ number_format($keranjangItems->subtotal , 0, ',', '.')}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            </table>
                            <h5 class="p-t-15 ltext-20 cl2 trans-04 txt-center">
                                Keranjang kamu kosong, silahkan berbelanja dulu 
                            </h5>
                        @endif
                    </div>
                </div>
                <button type="submit" name="cekout" class="floating-button disabled-button" id="cekout-button">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
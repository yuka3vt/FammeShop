@extends('base.index')
@section('konten')
<!-- Slider -->
<!-- Product -->
<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Store Overview
            </h3>
        </div>

        <!-- Tab01 -->
        <div class="tab01">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item p-b-10">
                    <a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">New Produk</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#featured" role="tab">Best Seller</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#sale" role="tab">Biggest Wishlist</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content p-t-50">
                <!-- - -->
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach ($produkBaru as $item)
                                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                    <!-- Block2 -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            @if ($item->image ==="default")
                                                <div class="image-container-produk">
                                                    <img src="{{ asset('defaultProduk.png') }}" alt="Gambar" class="custom-image-produk">
                                                </div>
                                            @else
                                                <div class="image-container-produk">
                                                    <img src="{{ asset('storage/'.$item->image) }}" alt="Gambar" class="custom-image-produk">
                                                </div>
                                            @endif
                                            <a href="/shop/{{ $item->slug }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                                Quick View
                                            </a>
                                        </div>
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l ">
                                                <a href="/shop/{{ $item->slug }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $item->nama }}
                                                </a>
                                                <span class="stext-105 cl3">
                                                    @if ($item->diskon !== null)
                                                    Rp. <span class="strikethrough">
                                                        {{ number_format($item->harga, 0, ',', '.') }}
                                                    </span> &nbsp;<span>{{ number_format($item->hargaTotal, 0, ',', '.') }}</span>
                                                    @else
                                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- - -->
                <div class="tab-pane fade" id="featured" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach ($banyakDibeli as $item)
                                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                    <!-- Block2 -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            @if ($item->image ==="default")
                                                <div class="image-container-produk">
                                                    <img src="{{ asset('defaultProduk.png') }}" alt="Gambar" class="custom-image-produk">
                                                </div>
                                            @else
                                                <div class="image-container-produk">
                                                    <img src="{{ asset('storage/'.$item->image) }}" alt="Gambar" class="custom-image-produk">
                                                </div>
                                            @endif
                                            <a href="/shop/{{ $item->slug }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                                Quick View
                                            </a>
                                        </div>
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l ">
                                                <a href="/shop/{{ $item->slug }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $item->nama }}
                                                </a>
                                                <span class="stext-105 cl3">
                                                    @if ($item->diskon !== null)
                                                    Rp. <span class="strikethrough">
                                                        {{ number_format($item->harga, 0, ',', '.') }}
                                                    </span> &nbsp;<span>{{ number_format($item->hargaTotal, 0, ',', '.') }}</span>
                                                    @else
                                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- - -->
                <div class="tab-pane fade" id="sale" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach ($banyakDisuka as $item)
                                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                    <!-- Block2 -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            @if ($item->image ==="default")
                                                <div class="image-container-produk">
                                                    <img src="{{ asset('defaultProduk.png') }}" alt="Gambar" class="custom-image-produk">
                                                </div>
                                            @else
                                                <div class="image-container-produk">
                                                    <img src="{{ asset('storage/'.$item->image) }}" alt="Gambar" class="custom-image-produk">
                                                </div>
                                            @endif
                                            <a href="/shop/{{ $item->slug }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                                Quick View
                                            </a>
                                        </div>
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l ">
                                                <a href="/shop/{{ $item->slug }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $item->nama }}
                                                </a>
                                                <span class="stext-105 cl3">
                                                    @if ($item->diskon !== null)
                                                    Rp. <span class="strikethrough">
                                                        {{ number_format($item->harga, 0, ',', '.') }}
                                                    </span> &nbsp;<span>{{ number_format($item->hargaTotal, 0, ',', '.') }}</span>
                                                    @else
                                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.blogHome')
@endsection
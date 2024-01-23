@extends('base.index')
@section('konten')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1 rs1-slick1">
        <div class="slick1">
            <div class="item-slick1" style="background-image: url(/website/images/slide-03.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2">
                                New Collection {{ now()->format('Y') }}
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                New arrivals
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="/shop" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1" style="background-image: url(/website/images/slide-02.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2">
                                Men New-Season
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                Jackets & Coats
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1" style="background-image: url(/website/images/slide-04.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2">
                                Women Collection {{ now()->format('Y') }}
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                NEW SEASON
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="/shop" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                                                    @if ($item->diskon !== 0)
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
                                                    @if ($item->diskon !== 0)
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
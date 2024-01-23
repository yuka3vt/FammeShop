@can('user')
    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Keranjang Saya 
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>
            
            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    @if ($dataKeranjang->count())
                        @foreach ($dataKeranjang as $keranjang)
                            <li class="header-cart-item flex-w flex-t m-b-12 bor12">
                                <div class="header-cart-item-img">
                                    @if ($keranjang->produk->image ==="default")
                                        <img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
                                    @else
                                        <img src="{{ asset('storage/'.$keranjang->produk->image) }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
                                    @endif
                                </div>
                                <div class="header-cart-item-txt p-t-8">
                                    <a href="/shop/{{ $keranjang->produk->slug }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        {{ $keranjang->produk->nama }}
                                    </a>
                                    <span class="header-cart-item-info">
                                        Size : {{ $keranjang->ukuran }} &nbsp;&nbsp;&nbsp; Warna : {{ $keranjang->warna }}
                                    </span>
                                    <span class="header-cart-item-info">
                                        @if ($keranjang->produk->diskon !== 0)
                                        Rp. <span class="strikethrough">
                                            {{ number_format($keranjang->produk->harga, 0, ',', '.') }}
                                        </span> &nbsp;<span>{{ number_format($keranjang->produk->hargaTotal, 0, ',', '.') }}</span>
                                        @else
                                            Rp. {{ number_format($keranjang->produk->harga, 0, ',', '.') }}
                                        @endif
                                    x {{ $keranjang->jumlah }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <div class="header-cart-item-txt p-t-8">
                            <p class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                Keranjang Kamu Kosong
                            </p>
                        </div>
                    @endif
                </ul>
                
                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        @if ($dataKeranjang->count())
                            @php
                                $totalSubtotal = 0;
                            @endphp
                            @foreach ($dataKeranjang as $item)
                                @php
                                    $totalSubtotal += $item->subtotal;
                                @endphp
                            @endforeach
                            Total : {{ number_format($totalSubtotal, 0, ',', '.')}}
                        @else
                            Total : Rp. 0
                        @endif
                    </div>

                    <div class="header-cart-button">
                        <a href="/keranjang/{{ auth()->user()->username }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 {{ $dataKeranjang->count() <= 0 ? 'disabled-button' : '' }} ">
                            Keranjang Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
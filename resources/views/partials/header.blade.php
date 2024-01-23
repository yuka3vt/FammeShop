<!-- Header -->
<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->		
                <a href="/" class="logo">
                    <h4 style="color: black;font-weight: bold">
                        Femme<span style="font-weight: 500;color: grey">Shop</span>
                    </h4>
                </a>
                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ ($judul ==="Femme Shop")?'active-menu':'' }}">
                            <a href="/">Home</a>
                        </li>
                        @auth
                            <li class="{{ ($judul ==="Shop")?'active-menu':'' }}">
                                <a href="/shop">Shop</a>
                            </li>
                        @endauth
                        <li class="{{ ($judul ==="Blog")?'active-menu':'' }}">
                            <a href="/blog">Blog</a>
                        </li>
                        <li class="{{ ($judul ==="Hubungi")?'active-menu':'' }}">
                            <a href="/hubungi">Hubungi</a>
                        </li>
                    </ul>
                </div>	
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <ul class="main-menu">
                        @guest
                            <li>
                                <a href="/login">Login <i class="fa fa-sign-in"></i></a>
                            </li>
                        @endguest
                        @can('user')
                            @if (strtolower($judul) !=='add cart' && strtolower($judul) !=='proses pesanan')
                                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart {{ ($judul ==="Keranjang")?'icon-aktif':'' }}" data-notify="{{ $dataKeranjang->count() }}">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                                <a href="/wishlist/{{ auth()->user()->username }}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti {{ ($judul ==="Wishlist")?'icon-aktif':'' }}" data-notify="{{ $dataSuka->count() }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                            @endif
                        @endcan
                    </ul>
                    @auth    
                        <ul class="menu">
                            <li class="dropdown">
                                <a>
                                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart">
                                        <i class="fa fa-cog"></i>
                                    </div>
                                </a>
                                <ul class="submenu">
                                    @can('admin')
                                        <li><a class="styled-button" href="/admin/dashboard">Dashboard &nbsp;<i class="fa fa-tachometer" aria-hidden="true"></i></a></li>
                                    @endcan
                                    @can('user')
                                        <li><a class="styled-button" href="/profil/{{ auth()->user()->username }}">Profil</a></li>
                                        <li><a class="styled-button" href="/keranjang/{{ auth()->user()->username }}">Keranjang</a></li>
                                        <li><a class="styled-button" href="/pesanan/{{ auth()->user()->username }}">Pesanan</a></li>
                                    @endcan
                                    <li class="divider"></li>
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button type="submit" class="styled-button">Log out &nbsp;<i class="fa fa-sign-in"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </nav>
        </div>	
    </div>
    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="/"><img src="{{ asset ('website/images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
        </div>
        <!-- Icon header -->
        @can('user')
            @if (strtolower($judul) !=='add cart' && strtolower($judul) !=='proses pesanan')
                <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{ $dataKeranjang->count() }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <a href="/wishlist/{{ auth()->user()->username }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="{{ $dataSuka->count() }}">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            @endif
        @endcan
        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger js-show-menu-side">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>
</header>
@include('partials.modalMenu')
@if(strtolower($judul) !=='add cart' && strtolower($judul) !=='proses pesanan')
    @include('partials.modalKeranjang')
@endif

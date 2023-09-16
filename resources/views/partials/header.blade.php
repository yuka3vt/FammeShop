<!-- Header -->
<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->		
                <a href="/" class="logo">
                    <img src="{{ asset('website/images/icons/logo-01.png') }}" alt="IMG-LOGO">
                </a>
                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        @guest
                            <li class="{{ ($judul ==="Femme Shop")?'active-menu':'' }}">
                                <a href="/">Home</a>
                            </li>
                            <li class="{{ ($judul ==="Blog")?'active-menu':'' }}">
                                <a href="/blog">Blog</a>
                            </li>
                            <li class="{{ ($judul ==="Tentang")?'active-menu':'' }}">
                                <a href="/tentang">Tentang</a>
                            </li>
                            <li class="{{ ($judul ==="Hubungi")?'active-menu':'' }}">
                                <a href="/hubungi">Hubungi</a>
                            </li>
                        @endguest
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
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                            <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                                <i class="zmdi zmdi-favorite-outline"></i>
                            </a>
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
                                    <li><a href="index.html">Profile</a></li>
                                    <li><a href="home-02.html">Homepage 2</a></li>
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
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>
        @endcan
        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            @guest
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/blog">Blog</a>
                </li>

                <li>
                    <a href="/tentang">Tentang</a>
                </li>

                <li>
                    <a href="/hubungi">Hubungi</a>
                </li>
                <li>
                    <a href="/login">Login</a>
                </li>
            @endguest
            @can('user')

            @elsecan('admin')
            
            @endcan
            @auth
                <li>
                    <a href="">Profile</a>
                </li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="styled-button-m">Log out</button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</header>
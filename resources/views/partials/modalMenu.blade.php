<!-- Cart -->
<div class="wrap-header-cart js-panel-menu-side">
    <div class="s-full js-hide-menu-side"></div>
    <div class="header-side flex-col-l">
        <div class="header-menu-title p-r-10 p-l-10 p-t-20">
            <div class="d-flex flex-column flex-shrink-0">
                @auth
                <a class="cl2" href="/profil/{{ auth()->user()->username }}">
                    <table>
                        <tbody>
                            <th class=" p-l-6">
                                <h6 class="font">{{ auth()->user()->nama }}</h6>
                                <p class="text-10">{{ auth()->user()->username }}</p>
                            </th>
                        </tbody>
                    </table>
                </a>
                @endauth
            </div>
            <div class="d-flex flex-column flex-shrink-0">
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link  cl2 {{ ($judul ==="Femme Shop")?'active':'' }}"
                            aria-current="page">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/shop" class="nav-link  cl2 {{ ($judul ==="Shop")?'active':'' }}">
                            Shop
                        </a>
                    </li>
                    <li>
                        <a href="/blog" class="nav-link cl2 {{ ($judul ==="Blog")?'active':'' }}">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="/tentang" class="nav-link  cl2 {{ ($judul ==="Tentang")?'active':'' }}">
                            Tentang
                        </a>
                    </li>
                    <li>
                        <a href="/hubungi" class="nav-link  cl2 {{ ($judul ==="Hubungi")?'active':'' }}">
                            Hubungi
                        </a>
                    </li>
                    @auth
                        <li class="border-top my-3"></li>
                        <li class="mb-1">
                            <div class="row nav-link" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                                <i class="fa fa-caret-right {{($judul==='Profil'||$judul==='Pesanan'||$judul==='Keranjang')?'rotate-90':''}}" id="account" aria-hidden="true"></i>
                                <a class="cl2 p-l-4">Account</a>
                            </div>
                            <div class="collapse {{($judul==='Profil'||$judul==='Pesanan'||$judul==='Keranjang')?'show':''}}" id="account-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    @can('pengguna')
                                        <li><a href="/profil/{{ auth()->user()->username }}" class=" nav-link  cl2 link-dark rounded {{ ($judul ==="Profil")?'active':'' }}">Profil</a></li>
                                        <li><a href="/pesanan/{{ auth()->user()->username }}" class=" nav-link  cl2 link-dark rounded {{ ($judul ==="Pesanan")?'active':'' }}">Pesanan</a></li>
                                        <li><a href="/keranjang/{{ auth()->user()->username }}" class=" nav-link  cl2 link-dark rounded {{ ($judul ==="Keranjang")?'active':'' }}">Keranjang</a></li>
                                    @endcan
                                    @can('admin')
                                        <li><a href="/admin/dashboard" class=" nav-link  cl2 link-dark rounded">Dashboard</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endauth
                </ul>
                <hr>
            </div>
        </div>
        <div class="d-grid gap-2 cl2 bottom-text flex-c-m stext-101 cl0 size-116  trans-04 pointer m-b-15">
            @guest
            <a href="/login" class="btn btn-primary">Login &nbsp;<i class="fa fa-sign-in"></i></a>
            @endguest
            @auth
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Log out &nbsp;<i class="fa fa-sign-in"></i></button>
            </form>
            @endauth
        </div>
    </div>
</div>

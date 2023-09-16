<div class="col-md-4 col-lg-3 p-b-80">
    <div class="side-menu">'
        <form action="/blog">
            @if (request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <div class="bor17 of-hidden pos-relative">
                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </form>
        <div class="p-t-50">
            <h4 class="mtext-112 cl2 p-b-27">
                Kategori
            </h4>

            <div class="flex-w m-r--5">
                @foreach ($kategoris as $blogkategori)
                <a href="/blog?kategori={{ $blogkategori->slug }}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    {{ $blogkategori->nama }}
                </a>
                @endforeach
            </div>
        </div>
        <div class="p-t-65">
            <h4 class="mtext-112 cl2 p-b-33">
                Top 3 produk
            </h4>

            <ul>
                <li class="flex-w flex-t p-b-30">
                    <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                        <img src="{{ asset ('website/images/product-min-01.jpg') }}" alt="PRODUCT">
                    </a>

                    <div class="size-215 flex-col-t p-t-8">
                        <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                            White Shirt With Pleat Detail Back
                        </a>

                        <span class="stext-116 cl6 p-t-20">
                            $19.00
                        </span>
                    </div>
                </li>

                <li class="flex-w flex-t p-b-30">
                    <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                        <img src="{{ asset ('website/images/product-min-02.jpg') }}" alt="PRODUCT">
                    </a>

                    <div class="size-215 flex-col-t p-t-8">
                        <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                            Converse All Star Hi Black Canvas
                        </a>

                        <span class="stext-116 cl6 p-t-20">
                            $39.00
                        </span>
                    </div>
                </li>

                <li class="flex-w flex-t p-b-30">
                    <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                        <img src="{{ asset ('website/images/product-min-03.jpg') }}" alt="PRODUCT">
                    </a>

                    <div class="size-215 flex-col-t p-t-8">
                        <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                            Nixon Porter Leather Watch In Tan
                        </a>

                        <span class="stext-116 cl6 p-t-20">
                            $17.00
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        
    </div>
</div>
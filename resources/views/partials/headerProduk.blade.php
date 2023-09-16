@include('partials.modalKeranjang')
<div class="flex-w flex-sb-m p-b-52">
    <div class="flex-w flex-l-m filter-tope-group m-tb-10">
        <a href="/produk" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1">
            Semua Produk
        </a>
        @foreach ($kategoris as $kategori)
            <a href="/produk?kategori={{ $kategori->slug }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                {{ $kategori->nama }}
            </a>
        @endforeach
    </div>

    <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
            <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
            <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
            Search
        </div>
    </div>
    
    <!-- Search product -->
    <div class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="bor8 dis-flex p-l-15">
            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                <i class="zmdi zmdi-search"></i>
            </button>
            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
        </div>	
    </div>

    <!-- Filter -->
    <div class="dis-none panel-filter w-full p-t-10">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                                
        </div>
    </div>
</div>
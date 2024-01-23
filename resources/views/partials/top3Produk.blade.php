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
    </div>
</div>
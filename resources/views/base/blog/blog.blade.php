@extends('base.index')
@section('konten')
<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!-- item blog -->
                    @if ($blogs->count())
                        @foreach ($blogs as $blog)
                            <div class="p-b-63">
                                <a href="/blog/{{ $blog->slug }}" class="hov-img0 how-pos5-parent">
                                    <img src="{{ asset ('website/images/blog-04.jpg') }}" alt="IMG-BLOG">

                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
                                        <span class="ltext-107 cl2 txt-center">
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}        
                                        </span>

                                        <span class="stext-109 cl3 txt-center">
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('M Y') }}
                                        </span>
                                    </div>
                                </a>

                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="/blog/{{ $blog->slug }}" class="ltext-108 cl2 hov-cl1 trans-04">
                                            {{ $blog->judul }}
                                        </a>
                                    </h4>

                                    <p class="stext-117 cl6">
                                        {{ $blog->kutipan }}
                                    </p>

                                    <div class="flex-w flex-sb-m p-t-18">
                                        <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                                            <span>
                                                <span class="cl4">By</span> {{ $blog->user->username  }} 
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>

                                            <span>
                                                @foreach ($blog->blogkategori as $key => $blogkategori)
                                                    {{ $blogkategori->nama }}
                                                    @if ($key < count($blog->blogkategori) - 1)
                                                        ,
                                                    @endif
                                                @endforeach
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>

                                            <span>
                                                {{ $blog->updated_at->diffForHumans() }}
                                            </span>
                                        </span>

                                        <a href="/blog/{{ $blog->slug }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                            Continue Reading

                                            <i class="fa fa-long-arrow-right m-l-9"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    @else
                    <h4 class="p-t-15 ltext-108 cl2 trans-04 txt-center">
                        Maaf blog tidak tersedia
                    </h4>
                    @endif
                    {{ $blogs->links('partials.pagination') }}
                </div>
            </div>
            @include('partials.top3Produk')
        </div>
    </div>
</section>	
@endsection
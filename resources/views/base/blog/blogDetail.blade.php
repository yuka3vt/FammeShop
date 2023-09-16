@extends('base.index')
@section('konten')
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="/blog" class="stext-109 cl8 hov-cl1 trans-04">
            Blog
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $blogs->judul }}
        </span>
    </div>
</div>
 
<!-- Content page -->
<section class="bg0 p-t-52 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!--  -->
                    <div class="wrap-pic-w how-pos5-parent">
                        <img src="{{ asset ('website/images/blog-04.jpg') }}" alt="IMG-BLOG">

                        <div class="flex-col-c-m size-123 bg9 how-pos5">
                            <span class="ltext-107 cl2 txt-center">
                                {{ \Carbon\Carbon::parse($blogs->created_at)->format('d') }}
                            </span>

                            <span class="stext-109 cl3 txt-center">
                                {{ \Carbon\Carbon::parse($blogs->created_at)->format('M Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="p-t-32">
                        <span class="flex-w flex-m stext-111 cl2 p-b-19">
                            <span>
                                <span class="cl4"></span> {{ $blogs->user->username  }}   
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>
                            <span>
                                @foreach ($blogs->blogkategori as $key => $blogkategori)
                                    {{ $blogkategori->nama }}
                                    @if ($key < count($blogs->blogkategori) - 1)
                                        ,
                                    @endif
                                @endforeach
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                Update, {{ $blogs->updated_at->diffForHumans() }}
                            </span>
                        </span>

                        <h4 class="ltext-109 cl2 p-b-28">
                            {{ $blogs->judul }}
                        </h4>

                        <p class="stext-117 cl6 p-b-26">
                            {{ $blogs->isi_blog }}
                        </p>
                    </div>

                    <div class="flex-w flex-t p-t-16">
                        <span class="size-216 stext-116 cl8 p-t-4">
                            Tags
                        </span>

                        <div class="flex-w size-217">
                            @foreach ($blogs->blogkategori as $blogkategori)
                                <a href="/blog?kategori={{ $blogkategori->slug }}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    {{ $blogkategori->nama }}
                                </a>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.top3Produk')
        </div>
    </div>
</section>
@endsection

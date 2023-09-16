<!-- Blog -->
@if ($blog->count())
    <section class="sec-blog bg0 p-t-60 p-b-90">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Our Blogs
                </h3>
            </div>
            <div class="row">
                @foreach ($blog as $blog)
                <div class="col-sm-6 col-md-4 p-b-40">
                    <div class="blog-item">
                        <div class="hov-img0">
                            <a href="/blog/{{ $blog->slug }}">
                                <img src="{{ asset ('/website/images/blog-01.jpg') }}" alt="IMG-BLOG">
                            </a>
                        </div>

                        <div class="p-t-15">
                            <div class="stext-107 flex-w p-b-14">
                                <span class="m-r-3">
                                    <span class="cl5">
                                        {{ $blog->user->username }}
                                    </span>
                                </span>

                                <span>
                                    <span class="cl12 m-l-4 m-r-6">|</span>

                                    <span class="cl5">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                                    </span>
                                </span>
                            </div>

                            <h4 class="p-b-12">
                                <a href="/blog/{{ $blog->slug }}" class="mtext-101 cl2 hov-cl1 trans-04">
                                    {{ $blog->judul }}
                                </a>
                            </h4>

                            <p class="stext-108 cl6">
                                {{ $blog->kutipan }}
                            </p>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>
@else
    
@endif

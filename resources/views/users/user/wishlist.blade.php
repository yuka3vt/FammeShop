@extends('users.user.index')
@section('konten')
	<!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
    
            <span class="stext-109 cl4">
                Wishlist Saya
            </span>
        </div>
    </div>
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140 wishMin">
		<div class="container ">
			<!-- Produk -->
			<div class="row " id="product-container ">
				@if ($dataSuka->count())
					@foreach ($dataSuka as $item)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								@if ($item->produk->image ==="default")
									<img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:345px;height:482px;object-fit:cover">
								@else
									<img src="{{ asset('storage/'.$item->produk->image) }}" alt="IMG" style="width:345px;height:482px;object-fit:cover">
								@endif
								<a href="/{{ $item->produk->slug }}" class="block2-btn flex-c-m stext-103 cl5 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-10">
									<i class="zmdi zmdi-shopping-cart"></i>
								</a>
								
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="/shop/{{ $item->produk->slug }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										{{ $item->produk->nama }}
									</a>

									<span class="stext-105 cl3">
										@if ($item->diskon !== 0)
										Rp. <span class="strikethrough">
											{{ number_format($item->harga, 0, ',', '.') }}
										</span> &nbsp;<span>{{ number_format($item->hargaTotal, 0, ',', '.') }}</span>
										@else
											Rp. {{ number_format($item->harga, 0, ',', '.') }}
										@endif
									</span>
								</div>
								<div class="block2-txt-child2 flex-r p-t-3">
									
								</div>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<h4 class="p-t-15 p-l-37 ltext-108 cl2 trans-04 txt-center">
						Wishlist produk kamu masih kosong 
					</h4>
				@endif
				{{ $dataSuka->links('partials.pagination') }}
			</div>
		</div>
	</div>
@endsection
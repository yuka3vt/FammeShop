@extends('users.user.index')
@section('konten')
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			@include('partials.headerProduk')
			<div class="row" id="product-container">
				@if ($dataProduk->count())
				@foreach ($dataProduk as $produk)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35">
						<div class="block2">
							<div class="block2-pic hov-img0">
								@if ($produk->image ==="default")
									<img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:345px;height:482px;object-fit:cover">
								@else
									<img src="{{ asset('storage/'.$produk->image) }}" alt="IMG" style="width:345px;height:482px;object-fit:cover">
								@endif
								<a href="/{{ $produk->slug }}" class="block2-btn flex-c-m stext-103 cl5 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-10">
									<i class="zmdi zmdi-shopping-cart"></i>
								</a>
							</div>
							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="/shop/{{ $produk->slug }}" class="stext-104 cl4 hov-cl1 trans-04 p-b-6">
										{{ $produk->nama }}
									</a>
									<span class="stext-105 cl3">
										@if ($produk->diskon !== null)
										Rp. <span class="strikethrough">
											{{ number_format($produk->harga, 0, ',', '.') }}
										</span> &nbsp;<span>{{ number_format($produk->hargaTotal, 0, ',', '.') }}</span>
										@else
											Rp. {{ number_format($produk->harga, 0, ',', '.') }}
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
					<h4 class="p-t-15 ltext-108 cl2 trans-04 txt-center">
						Maaf produk tidak tersedia
					</h4>
				@endif
				{{ $dataProduk->links('partials.pagination') }}
			</div>
		</div>
	</div>
@endsection
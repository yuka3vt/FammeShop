@extends('users.user.index')
@section('konten')
	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20 show-modal1">
		<div class="overlay-modal1 js-hide-modal1"></div>
		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<a href="#">
						<img src="{{ asset('website/images/icons/icon-close.png') }}" alt="CLOSE">
					</a>
				</button>
				<div class="row">
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							@if ($produks->image ==="default")
								<img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:345px;height:427px;object-fit:cover">
							@else
								<img src="{{ asset('storage/'.$produks->image) }}" alt="IMG" style="width:345px;height:427px;object-fit:cover">
							@endif
						</div>
					</div>
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								{{ $produks->nama }}
							</h4>
							<span class="mtext-106 cl2">
								@if ($produks->diskon !== 0)
								Rp. <span class="strikethrough">
									{{ number_format($produks->harga, 0, ',', '.') }}
								</span> &nbsp;<span>{{ number_format($produks->hargaTotal, 0, ',', '.') }}</span>
								@else
									Rp. {{ number_format($produks->harga, 0, ',', '.') }}
								@endif
							</span>
							<p class="stext-102 cl3 p-b-20 p-t-10">
								<span>Stok : {{ $produks->stok }}</span>
							</p>
							<!--  -->
							<form method="POST" action="/tambah-ke-keranjang">
								@csrf
								<input type="number" name="produkId" hidden value="{{ $produks->id }}">
								<input type="number" name="harga" hidden value="{{ $produks->hargaTotal }}">
								<div class="p-t-33">
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-203 flex-c-m respon6">
											Size
										</div>
										<div class="size-204 respon6-next">
											<div class="rs1-select2 bor8 bg0">
												<select class="js-select2" name="ukuran" required id="ukuranSelect">
													<option disabled selected value="">Ukuran</option>
														@foreach ($produks->produkukuran as $produkukuran)
															<option value="{{ $produkukuran->nama }}">{{ $produkukuran->nama }}</option>
														@endforeach
												</select>
												<div class="dropDownSelect2"></div>
											</div>
										</div>
									</div>
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-203 flex-c-m respon6">
											Color
										</div>
										<div class="size-204 respon6-next">
											<div class="rs1-select2 bor8 bg0">
												<select class="js-select2" name="warna" required id="warnaSelect">
													<option disabled selected value="">Warna</option>
													@foreach ($produks->produkwarna as $produkwarna)
														<option value="{{ $produkwarna->nama }}">{{ $produkwarna->nama }}</option>
													@endforeach
												</select>
												<div class="dropDownSelect2"></div>
											</div>
										</div>
									</div>
	
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-204 flex-w flex-m respon6-next">
											<div class="wrap-num-product flex-w m-r-20 m-tb-10">
												<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>
												<input class="mtext-104 cl3 txt-center num-product" type="number"  name="jumlah" value="1" min="1" max="{{ $produks->stok }}">
												<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
											<button id="addToCartButton" type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
												Add to cart
											</button>
										</div>
									</div>	
								</div>
							</form>
							<!--  -->
							
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								@php
									$isItemInWishlist = false;
									foreach ($dataSuka as $item) {
										if ($produks->id === $item->produk_id) {
											$isItemInWishlist = true;
											break;
										}
									}
								@endphp
								<div class="pos-relative m-r-11">
									@if ($isItemInWishlist)
									<form action="/wishlist/hapus-wishlist/{{$produks->slug}}" method="POST">
										@csrf
										<button class="tooltip100" type="submit" data-tooltip="Hapus dari Wishlist">
											<i class="fa fa-heart icon-love1" aria-hidden="true"></i>
										</button>
									</form>
									@else
									<form action="/wishlist/tambah-wishlist/{{$produks->slug}}" method="POST">
										@csrf
										<button class="tooltip100" type="submit" data-tooltip="Tambah ke Wishlist">
											<i class="fa fa-heart icon-love2" aria-hidden="true"></i>
										</button>
									</form>
									@endif
								</div>
								<a href="#" class="fs-24 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>
			
								<a href="#" class="fs-24 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>
			
								<a href="#" class="fs-24 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
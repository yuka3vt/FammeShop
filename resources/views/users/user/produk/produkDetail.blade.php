@extends('users.user.index')
@section('konten')
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-lg-5 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-pic-w pos-relative">
							@if ($dataProduk->image ==="default")
								<img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:345px;height:427px;object-fit:cover">
							@else
								<img src="{{ asset('storage/'.$dataProduk->image) }}" alt="IMG" style="width:345px;height:427px;object-fit:cover">
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-5 p-b-30" >
					<form method="POST" action="/tambah-ke-keranjang" class="p-r-50 p-t-5 p-lr-0-lg">
						@csrf	
						<input type="number" name="produkId" hidden value="{{ $dataProduk->id }}">
						<input type="number" name="harga" hidden value="{{ $dataProduk->hargaTotal }}">
						<h4 class="mtext-105 cl2 js-name-detail">
							{{ $dataProduk->nama }}
						</h4>
                        <p class="stext-102 cl3 p-b-20">
                            <span>Stok : {{ $dataProduk->stok }}</span>
						</p>
						<span class="mtext-106 cl2">
							@if ($dataProduk->diskon !== null)
							Rp. <span class="strikethrough">
								{{ number_format($dataProduk->harga, 0, ',', '.') }}
							</span> &nbsp;<span>{{ number_format($dataProduk->hargaTotal, 0, ',', '.') }}</span>
							@else
								Rp. {{ number_format($dataProduk->harga, 0, ',', '.') }}
							@endif
						</span>
						
						<!--  -->
						<div class="p-t-33">
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6">
									Size
								</div>
								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="ukuran" required>
											<option disabled selected value="">Choose an option</option>
												@foreach ($dataProduk->produkukuran as $produkukuran)
													<option>{{ $produkukuran->nama }}</option>
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
										<select class="js-select2" name="warna" required>
											<option disabled selected value="">Choose an option</option>
											@foreach ($dataProduk->produkwarna as $produkwarna)
												<option>{{ $produkwarna->nama }}</option>
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
										<input class="mtext-104 cl3 txt-center num-product" type="number" name="jumlah" min="1" max="{{ $dataProduk->stok }}" value="1">
										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
									<button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
										Add to cart
									</button>
								</div>
							</div>	
						</div>
					</form>
					<div class="flex-w flex-m p-l-100 p-t-40 respon7">
						@php
							$isItemInWishlist = false;
							foreach ($dataSuka as $item) {
								if ($dataProduk->id === $item->produk_id) {
									$isItemInWishlist = true;
									break;
								}
							}
						@endphp
						<div class="pos-relative m-r-11">
							@if ($isItemInWishlist)
							<form action="/wishlist/hapus-wishlist/{{$dataProduk->slug}}" method="POST">
								@csrf
								<button class="tooltip100" type="submit" data-tooltip="Hapus dari Wishlist">
									<i class="fa fa-heart icon-love1" aria-hidden="true"></i>
								</button>
							</form>
							@else
							<form action="/wishlist/tambah-wishlist/{{$dataProduk->slug}}" method="POST">
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
			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
						</li>
						<li class="nav-item p-b-10 ">
							<a class="nav-link disabled" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									{{ $dataProduk->deskripsi }}
								</p>
							</div>
						</div>
						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Weight
											</span>
											<span class="stext-102 cl6 size-206">
												{{ $dataProduk->berat }} kg
											</span>
										</li>
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>
											<span class="stext-102 cl6 size-206">
												{{ $dataProduk->dimensi }} cm
											</span>
										</li>
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Materials
											</span>
											<span class="stext-102 cl6 size-206">
												{{ $dataProduk->bahan }}
											</span>
										</li>
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>
											<span class="stext-102 cl6 size-206">
												@foreach ($dataProduk->produkwarna as $key => $produkwarna)
													{{ $produkwarna->nama }}
													@if ($key < count($dataProduk->produkwarna) - 1)
														,
													@endif
												@endforeach
											</span>
										</li>
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>
											<span class="stext-102 cl6 size-206">
												@foreach ($dataProduk->produkukuran as $key => $produkukuran)
													{{ $produkukuran->nama }}
													@if ($key < count($dataProduk->produkukuran) - 1)
														,
													@endif
												@endforeach
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- - -->
						<div class="tab-pane fade disabled" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="images/avatar-01.jpg" alt="AVATAR">
											</div>
											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>
													<span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
												</div>
												<p class="stext-102 cl6">
													Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
												</p>
											</div>
										</div>
										
										<!-- Add review -->
										<form class="w-full">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>
											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>
											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>
												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>
											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>
												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
												</div>
												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div>
											</div>
											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
                Categories : @foreach ($dataProduk->produkkategori as $key => $produkkategori)
                    {{ $produkkategori->nama }}
                    @if ($key < count($dataProduk->produkkategori) - 1)
                        ,
                    @endif
                @endforeach
			</span>
		</div>
	</section>
@endsection
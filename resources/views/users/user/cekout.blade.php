@extends('users.user.index')
@section('konten')
	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20 show-modal1">
		<div class="overlay-modal1 js-hide-modal1"></div>
		<div class="container">
			<div class="bg01 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<div class="row ">
					<div class="col-sm-10 col-lg-7 col-xl-10 m-lr-auto m-b-50 ">
						<form method="POST" action="/keranjang/cek-out">
						@csrf
						<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm bg02">
							<h4 class="mtext-90 cl2 p-b-20 bor12" style="text-align: center">
								Rincian Pesanan
							</h4>
							<div class="flex-w flex-t p-t-">
								<div class="size-208 w-full-ssm p-t-5">
									<span class="stext-110 cl2">
										Metode Pembayaran
									</span>
								</div>
								<div class="size-2081 p-r-18 p-r-0-sm w-full-ssm">
									<div>
										<div class="rs1-select2 rs2-select2 bor8 bg0 m-t-9">
											<select class="js-select2" name="pembayaran" required>
												<option disabled selected value="">Pembayaran</option>
												<option value="COD">COD</option>
												<option value="BCA">BCA</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="flex-w flex-t p-t-15 p-b-80">
								<div class="size-208 w-full-ssm p-t-5">
									<span class="stext-110 cl2">
										Alamat Pengiriman
									</span>
								</div>
								<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
									<div>
										<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
											<select class="js-select2" name="alamat" required>
												<option disabled selected value="">Pilih alamat pengiriman...</option>
												<option value="{{ $dataUser->provinsi }}, {{ $dataUser->kota }},{{ $dataUser->kecamatan }}, {{ $dataUser->kode_pos }}, {{ $dataUser->detail_alamat }}">
													{{ $dataUser->provinsi }}, {{ $dataUser->kota }},{{ $dataUser->kecamatan }}, {{ $dataUser->kode_pos }}, {{ $dataUser->detail_alamat }}
												</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="flex-w flex-t">
								<table class="table-cekot m-t-20 m-b-20">
									@foreach ($pesananProduk as $item)
										<tr class="table_row">
											<td class="column-11">
												@if ($item->produk->image ==="default")
													<img src="{{ asset('defaultProduk.png') }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
												@else
													<img src="{{ asset('storage/'.$item->produk->image) }}" alt="IMG" style="width:60px;height:80px;object-fit:cover">
												@endif
											</td>
											<td class="column-22">
												<input type="hidden" value="{{ $item->id }}"  name="keranjangId[]">
												<h5>{{ $item->produk->nama }}</h5>
												<span>{{ $item->warna }}, {{ $item->ukuran }}</span>
											</td>
											<td class="column-33">
												<span>{{ $item->jumlah }}</span>
												<h6>{{ number_format($item->subtotal, 0, ',', '.') }}</h6>
											</td>
										</tr>
									@endforeach
								</table>
							</div>
							
							<table class="m-t-20 m-b-20 ds" style="width: 100%">
								<tr>
									<th>Deskripsi</th>
									<th class="price">Harga</th>
								</tr>
								<tr>
									@php
										$totalSubtotal = 0;
									@endphp
									@foreach ($pesananProduk as $item)
										@php
											$totalSubtotal += $item->subtotal;
										@endphp
									@endforeach
									<td>Subtotal Produk</td>
									<td class="price">Rp. {{ number_format($totalSubtotal, 0, ',', '.') }}</td>
								</tr>
								<tr>
									<td>Subtotal Pengiriman</td>
									<input type="text" name="pengiriman" hidden value="0">
									<td class="price">Rp. <del>40.000</del></td>
								</tr>
								<tr>
									<td>Total Pesanan</td>
									<input type="text" name="subtotal" hidden value="{{ $totalSubtotal }}">
									<td class="price">Rp. {{ number_format($totalSubtotal, 0, ',', '.') }}</td>
								</tr>
							</table>
									
							<button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
								Proses Pesanan
							</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
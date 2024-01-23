@extends('email.index')
@section('konten')
    <div class="container">
        <div>
            <h1>Produk Baru</h1>
            <p>Hai {{ $nama }}</p>
        </div>
        <span></span>
        <p>Kami memiliki produk baru nih buat kamu</p>
        <img src="cid:nama_file_gambar.png" alt="Produk">
        <p>{{ $namaProduk }}</p>
    </div>
@endsection

@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<!-- DataTales Example -->
<section class="bg0 ">
    <div class="container py-5">
        @if (session()->has('error'))
            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show " role="alert">
                {{ session('error') }}
                <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                    <span class="" aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-end">
                            <a class="btn" data-toggle="modal" data-target="#modalProfil">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </div>
                        @if ($dataUser->image ==="default")
                            <img src="{{ asset('defaultUser.png') }}" alt="{{ $dataUser->username }}" class="rounded-circle img-fluid" style="width: 150px;height: 150px;object-fit: cover">
                        @else
                            <img src="{{ asset('storage/'.$dataUser->image) }}" alt="{{ $dataUser->username }}" class="rounded-circle img-fluid" style="width: 150px;height: 150px;object-fit: cover">
                        @endif
                        <h5 class="my-3 text-20">{{ $dataUser->username }}</h5>
                        <p class="text-muted mb-1 text-14">{{ $dataUser->telepon }}</p>
                        <p class="text-muted mb-4 text-14">{{ $dataUser->email }}</p>
                        <div class="d-flex justify-content-center mb-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Nama</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $dataUser->nama }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Gender</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $dataUser->jenis_kelamin }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Tempat Lahir</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $dataUser->tempat_lahir }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Tanggal Lahir</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 text-14">{{ $dataUser->created_at_formatted }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 text-14-bold">Alamat</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0 text-14">{{ $alamat }}</p>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn" data-toggle="modal" data-target="#modalAlamat"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="font" id="exampleModalLabel">Alamat</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <H4><i class="fa fa-times" aria-hidden="true"></i></H4>
                </a>
            </div>
            <div class="modal-body">
                <form action="/profil/{{ auth()->user()->username }}/update-alamat" method="POST">
                    @csrf
                    <div class="form-group font">
                        <label for="exampleFormControlSelect1">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item['province_id'] }}">{{ $item['province'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5 mb-3">
                            <div class="form-group font">
                                <label for="exampleFormControlSelect1">Kota</label>
                                <select class="form-control" id="kota" name="kota"></select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault04 font">Kecamatan</label>
                            <input name="kecamatan" type="text" class="form-control font" id="validationDefault04"
                                placeholder="Kecamatan" value="{{ $dataUser->kecamatan }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05 font">Kode Pos</label>
                            <input name="kode_pos" type="text" class="form-control font" id="validationDefault05"
                                placeholder="Kode Pos" required value="{{ $dataUser->kode_pos }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label font">Detail Lainnya</label>
                        <textarea name="detail_alamat" class="form-control" id="message-text"
                            required>{{ $dataUser->detail_alamat }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary font">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="font" id="exampleModalLabel">Profil</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <H4><i class="fa fa-times" aria-hidden="true"></i></H4>
                </a>
            </div>
            <div class="modal-body">
                <form action="/profil/{{ auth()->user()->username }}/update-profil" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="username" class="col-form-label font">Username</label>
                            <input name="username" type="text" class="form-control font" id="username" required
                                placeholder="Username" value="{{ $dataUser->username }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-10 mb-3">
                            <label for="foto" class="col-form-label font">Foto profil</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input font" name="image" id="customFileLangHTML" onchange="updateFileName(this)">
                                <label class="custom-file-label font" for="customFileLangHTML" data-browse="Choose">Choose file...</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="nama" class="col-form-label font">Nama</label>
                            <input name="nama" type="text" class="form-control font" id="nama" required
                                placeholder="Nama" value="{{ $dataUser->nama }}">
                        </div>
                        <div class="col-md-4">
                            <label for="inputgender" class="font col-form-label">Gender</label>
                            <select id="inputgender" class="form-control font" name="jenis_kelamin">
                                <option value="" disabled>Pilih gender</option>
                                <option value="Laki-Laki" {{ ($dataUser->jenis_kelamin ==="Laki-Laki")?'selected':'' }}>
                                    Laki-Laki</option>
                                <option value="Perempuan" {{ ($dataUser->jenis_kelamin ==="Perempuan")?'selected':'' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="telepon" class="col-form-label font">Telepon</label>
                            <input name="telepon" type="text" class="form-control font" id="telepon" required
                                placeholder="Telepon" value="{{ $dataUser->telepon }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03 font">Tempat lahir</label>
                            <input name="tempat_lahir" type="text" class="form-control font" id="validationDefault03"
                                placeholder="Tempat Lahir" value="{{ $dataUser->tempat_lahir }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03 font">Tanggal lahir</label>
                            <input name="tanggal_lahir" type="date" class="form-control font" id="validationDefault03"
                                value="{{ $dataUser->tanggal_lahir }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary font">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

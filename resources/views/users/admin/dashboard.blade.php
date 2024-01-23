@extends('users.admin.index')
@section('konten')
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <a href="" class="col-xl-3 col-md-6 mb-4 hover-none">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pendapatan (Bulan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($pendapatan, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <!-- Earnings (Monthly) Card Example -->
    <a href="/admin/pesanan" class="col-xl-3 col-md-6 mb-4 hover-none">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pesanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-cart-arrow-down fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <!-- Earnings (Monthly) Card Example -->
    <a href="/admin/blog-view" class="col-xl-3 col-md-6 mb-4 hover-none">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Blog Post
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $blog->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <!-- Pending Requests Card Example -->
    <a href="/admin/daftar-user" class="col-xl-3 col-md-6 mb-4 hover-none">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
@endsection

@extends('base')
@section('style')
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/styleCs.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    
@endsection
@section('body')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $h1 }}</h1>
                    </div>
                    @if (session()->has('sukses'))
                        <div id="alert" class="alert alert-success alert-dismissible fade show " role="alert">
                            {{ session('sukses') }}
                            <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                                <span class="" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('gagal'))
                        <div id="alert" class="alert alert-danger alert-dismissible fade show " role="alert">
                            {{ session('gagal') }}
                            <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                                <span class="" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @yield('konten')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        setTimeout(function() {
            $('#alert').alert('close');
        }, 5000);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nama').on('input', function() {
                const namaValue = $(this).val().toLowerCase();
                const slugValue = namaValue.trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^a-z0-9-]/g, '');
                $('#slug').val(slugValue);
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slugify/1.4.0/slugify.min.js"></script>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.3/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea.konten',
            height:500,
        })
    </script>
    <script>
        tinymce.init({
            selector:'textarea.deskripsi',
            height:200,
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kategori').multiselect({
                buttonWidth: '100%',
                maxHeight: 300,
                includeSelectAllOption: true, 
                selectAllText: 'Pilih Semua',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#warna').multiselect({
                buttonWidth: '100%',
                maxHeight: 300,
                includeSelectAllOption: true, 
                selectAllText: 'Pilih Semua',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ukuran').multiselect({
                buttonWidth: '100%',
                maxHeight: 300,
                includeSelectAllOption: true, 
                selectAllText: 'Pilih Semua',
            });
        });
    </script>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.parentElement.querySelector('.custom-file-label');
            label.textContent = fileName;
        }
    </script>
    <script>
        function formatHarga(input) {
            let harga = input.value.replace(/\D/g, '');
            if (harga.length > 0) {
                harga = parseInt(harga, 10).toLocaleString('id-ID');
            }
            input.value = harga;
        }
    </script>
    <script>
        $(document).ready(function(){
            $(".custom-file-input").change(function(){
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
    <script src="{{ asset('website/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
    $('.gallery-lb').each(function() { 
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });
    function goBack() {
        window.history.back();
    }
    </script>
        <script>
            function updateFileName(input) {
                var fileName = input.files[0].name;
                var label = input.parentElement.querySelector('.custom-file-label');
                label.textContent = fileName;
            }
        </script>
</body>
@endsection

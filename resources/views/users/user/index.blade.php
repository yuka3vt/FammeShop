@extends('base')
@section('style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/main.css') }}">   
@endsection
@section('body')
<body>
    @include('partials.header')
    @yield('konten')
    @if ($footer === 'tidak')
    @else
        @include('partials.footer')
    @endif
    <script src="{{ asset('website/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('website/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('website/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('website/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/vendor/select2/select2.min.js') }}"></script>
    <script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
    </script>
    
    <script>
        $(document).ready(function(){
            $(".custom-file-input").change(function(){
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
    <script src="{{ asset('website/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('website/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('website/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('website/js/slick-custom.js') }}"></script>
    <script src="{{ asset('website/vendor/parallax100/parallax100.js') }}"></script>
    <script>
    $('.parallax100').parallax100();
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
    <script>
        setTimeout(function() {
            $('#errorAlert').alert('close');
        }, 5000);
    </script>
    <script src="{{ asset('website/vendor/isotope/isotope.pkgd.min.js') }}"></>
    <script src="{{ asset('website/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
    $('.js-addwish-b2').on('click', function(e){
        e.preventDefault();
    });
    $('.js-addwish-b2').each(function(){
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });
    $('.js-addwish-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });
    $('.js-addcart-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function(){
            swal(nameProduct, "Produk Sudah di Tambahkan !", "success");
        });
    });
    </script>
    <script src="{{ asset('website/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });
    </script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#ceklist-semua").change(function() {
                $(".item-ceklist").prop("checked", this.checked);
            });
            $(".item-ceklist").change(function() {
                if (!this.checked) {
                    $("#ceklist-semua").prop("checked", false);
                }
            });
        });
    </script>
    <script>
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();   
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleRotation() {
            var accountDiv = document.getElementById('account');
            accountDiv.classList.toggle('rotate-90');
        }

        var accountLink = document.querySelector('.nav-link a');
        accountLink.addEventListener('click', function(event) {
            event.preventDefault();
            toggleRotation();
        });
  </script>
</body>    
@endsection
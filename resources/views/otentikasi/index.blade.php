@extends('Base')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('auth/css/main.css') }}">
@endsection
@section('body')
<body>
    @yield('konten')
    
    <script src="{{ asset ('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset ('auth/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset ('auth/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset ('auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('auth/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset ('auth/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset ('auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset ('auth/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset ('auth/js/main.js') }}"></script>
    <script>
        function showNotification() {
            const notification = document.querySelector('.floating-notification');
            if (notification) {
            notification.style.opacity = 1;
            setTimeout(() => {
                notification.style.opacity = 0;
            }, 5000);
            notification.style.top = '10px';
            notification.style.left = '50%';
            notification.style.transform = 'translateX(-50%)';
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            showNotification();
        });
    </script>
</body>    
@endsection
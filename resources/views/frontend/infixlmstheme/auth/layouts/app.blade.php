<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<!--     <title>{{ Settings('site_title')  }}</title>
 -->    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{getCourseImage(Settings('favicon') )}}">

    <x-frontend-dynamic-style-color/>


<!--     <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/app.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/frontend_style.css">  -->
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/signup.css') }}">


    <!-- bootstrap-->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" /> 


    <script src="{{asset('public/js/common.js')}}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/app.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/gijgo.min.css">
    <script src="{{ asset('public/frontend/infixlmstheme') }}/js/gijgo.min.js"></script>
    <link rel="stylesheet" href="{{asset('public/backend/css/themify-icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/preloader.css')}}"/>
    <script>
        window._locale = '{{ app()->getLocale() }}';
        window._translations = {!! json_encode(cache('translations'), JSON_INVALID_UTF8_IGNORE) !!}
    </script>
</head>

<body>
@include('secret_login')
@include('preloader')

@yield('content')


{!! \Brian2694\Toastr\Facades\Toastr::message() !!}
{!! NoCaptcha::renderJs() !!}

<script>
    if ($('.small_select').length > 0) {
        $('.small_select').niceSelect();
    }

    if ($('.datepicker').length > 0) {
        $('.datepicker').datepicker();
    }
    setTimeout(function () {
        $('.preloader').fadeOut('hide', function () {
            // $(this).remove();

        });
    }, 0);
</script>
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <!-- JS code Toggle password -->
  <script>
    const passwordInput = document.querySelector(".pass");
    const togglePasswordButton = document.querySelector(".toggle-password");

    togglePasswordButton.addEventListener("click", () => {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
      } else {
        passwordInput.type = "password";
        togglePasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
      }
    });
  </script>
</body>


</html>

<!DOCTYPE html>
<html lang="ar"
      dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('page-title') | لوحة التحكم</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="{{url('dashboard-assets')}}/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="{{url('dashboard-assets')}}/css/app.css"
              rel="stylesheet">
        <link type="text/css"
              href="{{url('dashboard-assets')}}/css/app.rtl.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="{{url('dashboard-assets')}}/css/vendor-material-icons.css"
              rel="stylesheet">
        <link type="text/css"
              href="{{url('dashboard-assets')}}/css/vendor-material-icons.rtl.css"
              rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css"
              href="{{url('dashboard-assets')}}/css/vendor-fontawesome-free.css"
              rel="stylesheet">
        <link type="text/css"
              href="{{url('dashboard-assets')}}/css/vendor-fontawesome-free.rtl.css"
              rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id=UA-133433427-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-133433427-1');
        </script>

    </head>

    <body class="layout-login">

        <div class="layout-login__overlay"></div>

        <div class="layout-login__form bg-white"
        data-perfect-scrollbar>
       <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
           <a href="#"
              class="navbar-brand"
              style="min-width: 0">
               <img class="navbar-brand-icon"
                    src="{{url('dashboard-assets')}}/images/logo.png"
                    width="25"
                    alt="Up-Platform">
               <span>Up-Platform</span>
           </a>
       </div>
        @yield('content')
       </div>
        
        <!-- jQuery -->
        <script src="{{url('dashboard-assets')}}/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="{{url('dashboard-assets')}}/vendor/popper.min.js"></script>
        <script src="{{url('dashboard-assets')}}/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{url('dashboard-assets')}}/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="{{url('dashboard-assets')}}/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="{{url('dashboard-assets')}}/vendor/material-design-kit.js"></script>

        <!-- App -->
        <script src="{{url('dashboard-assets')}}/js/toggle-check-all.js"></script>
        <script src="{{url('dashboard-assets')}}/js/check-selected-row.js"></script>
        <script src="{{url('dashboard-assets')}}/js/dropdown.js"></script>
        <script src="{{url('dashboard-assets')}}/js/sidebar-mini.js"></script>
        <script src="{{url('dashboard-assets')}}/js/app.js"></script>

        <!-- App Settings (safe to remove) -->
        <script src="{{url('dashboard-assets')}}/js/app-settings.js"></script>

    </body>

</html>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('page_title') | لوحة التحكم</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots"
            content="noindex">

    <!-- Styles -->
    @include('layouts.dashboard.styles')

</head>

<body class="layout-mini">

    <div class="preloader"></div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->
        @include('layouts.dashboard.header')
        <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                        <div class="container-fluid page__heading-container">
                            @yield('heading')
                        </div>

                        <div class="container-fluid page__container">
                            @yield('content')
                        </div>

                    </div>
                    <!-- // END drawer-layout__content -->

                    @include('layouts.dashboard.sidebar')
                </div>
                <!-- // END drawer-layout -->

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->

        <!-- // Scripts -->
        @include('layouts.dashboard.scripts')

    </body>

</html>
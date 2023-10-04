<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
            content="IE=edge">
    <meta name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots"
            content="noindex">

    <!-- Styles -->
    @include('layouts.dashboard.styles')

</head>

<body class="layout-default">

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
                            <div class="page__heading d-flex align-items-end">
                                <div class="flex">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">Dashboard</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Dashboard</h1>
                                </div>
                                <div class="flatpickr-wrapper ml-3">
                                    <div id="recent_orders_date"
                                         data-toggle="flatpickr"
                                         data-flatpickr-wrap="true"
                                         data-flatpickr-mode="range"
                                         data-flatpickr-alt-format="d/m/Y"
                                         data-flatpickr-date-format="d/m/Y">
                                        <a href="javascript:void(0)"
                                           class="link-date"
                                           data-toggle>13/03/2018 to 20/03/2018</a>
                                        <input class="flatpickr-hidden-input"
                                               type="hidden"
                                               value="13/03/2018 to 20/03/2018"
                                               data-input>
                                    </div>
                                </div>
                            </div>
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
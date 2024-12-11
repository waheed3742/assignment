<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="./images/favicon.png">
        <!-- Page Title  -->
        <title>e-Commerce Home | DashLite Admin Template</title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{asset('assets/css/dashlite.css?ver=3.2.3') }}">
        <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.2.3') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <body class="nk-body bg-lighter npc-general has-sidebar ">
            <div class="nk-app-root">
                <div class="nk-main ">
                    @include('admin.layouts.partials.sidebar')
                <div class="nk-wrap">
                    @include('admin.layouts.partials.header')

                    @yield('content')

                    @include('admin.layouts.partials.footer')
                </div>
                </div>
            </div>
        <script src="{{asset('assets/js/bundle.js?ver=3.2.3') }}"></script>
        <script src="{{asset('assets/js/scripts.js?ver=3.2.3') }}"></script>
        <script src="{{asset('assets/js/charts/chart-ecommerce.js?ver=3.2.3') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

    @stack('custom_scripts')
    </body>
    
</html>

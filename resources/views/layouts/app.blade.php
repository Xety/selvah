<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>{{ config('app.title') . ' - ' . config('app.name') }}</title>

        <!-- Meta -->
        @stack('meta')

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Miriam+Libre:wght@400;700&display=swap" rel="stylesheet">

        <!-- Embed Styles -->
        @stack('style')

        @livewireStyles

        <!-- Styles -->
        @vite('resources/css/selvah.css')

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

        <!-- Embed Scripts -->
        @stack('scriptsTop')
    </head>
    <body>

        <div id="selvah-vue">

            <div class="drawer lg:drawer-open">
                <!-- Toggle Responsive-->
                <input id="selvah-drawer" type="checkbox" class="drawer-toggle" />

                <div class="drawer-content flex flex-col">
                    <!-- Header -->
                    @include('elements.header')

                    <!-- Flash Messages -->
                    @include('elements.flash')

                    <main>
                        <!-- Content -->
                        @yield('content')
                    </main>

                    <!-- Footer -->
                    @include('elements.footer')

                </div>

                <!-- Sidebar -->
                @include('elements.sidebar')
            </div>
        </div>

        <!-- Scroll to Top button -->
        <x-scrolltotop />

        <!-- CSRF JS Token -->
        <script type="text/javascript">
            window.Selvah = {!! json_encode(['csrfToken' => csrf_token()]) !!}
        </script>

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/e3046f3b08.js" crossorigin="anonymous"></script>

        @vite('resources/js/selvah.js')
        @livewireScripts

        <!-- Embed Scripts -->
        @stack('scripts')
    </body>
</html>
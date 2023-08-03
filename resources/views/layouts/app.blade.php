<!--
Conçu et développé par Emeric Fèvre.

@2023 Selvah, Tous droits réservés.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

        <!-- Title -->
        <title>{{ config('app.title') . ' - ' . config('app.name') }}</title>

        <!-- Meta -->
        @stack('meta')

        <script type="text/javascript">
            /**
             * Dark Mode
             * On page load or when changing themes, best to add inline in `head` to avoid FOUC
             */
            if (localStorage.getItem('nightMode') == 'true' ||
                (!('nightMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.dataset.theme = "dark";
                localStorage.setItem("nightMode", true);
            }
        </script>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Miriam+Libre:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css" />

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

                    <main class="shadow-inner bg-slate-100 dark:bg-base-100">
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

        @vite('resources/js/selvah.js')
        @livewireScripts
        <!-- Change Livewire expiration message -->
        <script type="text/javascript">
            window.livewire.onError(statusCode => {
                if (statusCode === 419) {
                    confirm('Cette page a expirée.') && window.location.reload()

                    return false
                }
            });
        </script>

        <!-- Embed Scripts -->
        @stack('scripts')
    </body>
</html>
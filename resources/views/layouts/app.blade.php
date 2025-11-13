<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @use('AnisAronno\MediaHelper\Facades\Media')

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />

    <title>@yield('title', 'Inusittá')</title>

    <meta name="description"
        content="Admin Toolkit is a modern admin dashboard template based on Tailwindcss. It comes with a variety of useful ui components and pre-built pages" />

    {{-- Manifest + PWA --}}
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#2563eb">

<!-- iOS suporte -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="Inusittá">

<!-- Ícones Apple -->
<link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180.png">
<link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-icon-152.png">
<link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76.png">

<script>
    window.currentRoute = '{{ Route::currentRouteName() }}';
    window.enableToast = true;
</script>

@vite(['resources/scss/app.scss', 'resources/js/app.js'])


    <script>
        if (
            localStorage.getItem('theme') === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>


</head>

<body>
    <div id="app">
        <!-- Sidebar Starts -->
        <x-sidebar />
        <!-- Sidebar Ends -->

        <!-- Wrapper Starts -->
        <div class="wrapper">
            <!-- Header Starts -->
            <x-header />
            <!-- Header Ends -->

            <!-- Page Content Starts -->
            <div class="content">
                <!-- Main Content Starts -->
                <main class="container flex-grow p-2 sm:p-4 md:p-6">
                    {{ $slot }}
                </main>
                <!-- Main Content Ends -->

                    <!-- Toasts Globais -->
               <x-toast />
                <!-- Footer Starts -->
                <x-footer />
                <!-- Footer Ends -->
            </div>
            <!-- Page Content Ends -->
        </div>
        <!-- Wrapper Ends -->

        <!-- Search Modal Start -->
        <x-search-modal />
        <!-- Search Modal Ends -->
    </div>

    {{-- 🔹 Registrar Service Worker --}}
    <script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker
                .register("/service-worker.js")
                .then(() => console.log("✅ Service Worker registrado"))
                .catch((err) => console.error("Erro SW:", err));
        }
    </script>
</body>

</html>

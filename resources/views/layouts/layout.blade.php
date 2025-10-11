<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1.png') }}">
    <link rel="stylesheet" href="{{ asset('css/reuse.css') }}">
    
    {{-- ✅ TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ✅ Iconify for icons --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    {{-- ✅ SweetAlert2 for modals --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ✅ Alpine.js for reactivity --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- ✅ Vite styles --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
    {{-- ✅ Main Page Content --}}
    @yield('content')

    {{-- ✅ JS Libraries --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- ✅ ApexCharts for analytics and dashboards --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- ✅ Allow pushing extra scripts per page --}}
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reuse.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')

</head>


<body class="bg-gray-100 font-sans">
    @yield('content')

   <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
   <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')

</body>
</html>

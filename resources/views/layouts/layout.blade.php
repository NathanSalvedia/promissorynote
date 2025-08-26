<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        @vite('resources/css/app.css')

</head>


<body class="bg-gray-100 font-sans">
    @yield('content')

 <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

</body>
</html>

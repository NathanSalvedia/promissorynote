<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="./public" href="{{ asset('../img/logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturMaguntia&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        @vite('resources/css/app.css')

</head>


<body class="bg-gray-100 font-sans">
    @yield('content')

  

</body>
</html>
<style>
  .spc-wordmark{
    font-family: 'UnifrakturMaguntia', serif;
    color:#660809;
    line-height:1;
  }
</style>
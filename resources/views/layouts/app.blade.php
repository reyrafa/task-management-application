<html lang="en">

<head>
    <title>{{ $title ?? 'Task Management Application' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>
<style>
    .poppins-regular {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .body {
        padding: 0;
        margin: 0;

    }
</style>
@stack('styles')
<body class="poppins-regular body">
<div class="container min-vh-100">
    <div class="mt-3">@include('includes.navbar')</div>
    <div class="mt-3">
        <h1>{{ $page_title ?? 'Landing Page' }}</h1>
    </div>

    <div>
        {{ $slot }}

    </div>
    @stack('scripts')
    @livewireScripts

</div>
<div class="">@include('includes.footer')</div>
</body>

</html>

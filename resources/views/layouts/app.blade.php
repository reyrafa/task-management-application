<html lang="en">
<head>
    <title>{{ $title ?? 'Task Management Application' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/js/app.js','resources/css/app.css'])
    @livewireStyles
</head>
<style>
    .poppins-regular {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
    }
</style>
<body class="poppins-regular">
<div class="container">
    <div class="mt-3">
        <h1>{{ $page_title ?? 'Landing Page' }}</h1>
    </div>

    <div>
        {{ $slot }}
    </div>
    @livewireScripts
</div>

</body>
</html>

<html lang="en">
<head>
    <title>{{ $title ?? 'Task Management Application' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap"
          rel="stylesheet">
    @vite(['resources/js/app.js','resources/css/app.css'])
    @livewireStyles
</head>
<body>
<div class="container">
    <h1>{{ $page_title ?? 'Landing Page' }}</h1>
    <div>
        {{ $slot }}
    </div>
    @livewireScripts
</div>

</body>
</html>

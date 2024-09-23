<html lang="en">
<head>
    <title>{{ $title ?? 'Task Management Application' }}</title>
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

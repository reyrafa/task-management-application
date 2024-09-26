<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="/" wire:navigate>Task Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" aria-current="page" href="/" wire:navigate>Home</a>
                @guest
                    <a class="nav-link" href="{{ route('login') }}" wire:navigate>Login</a>
                @else
                    <a href="{{ route('task_management') }}" class="nav-link" wire:navigate>Task Management</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>Profile</a></li>
                            <li>@livewire('logout')</li>
                        </ul>
                    </li>
                @endguest


            </div>
        </div>
    </div>
</nav>

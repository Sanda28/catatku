<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">Catatku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <button id="dark-mode-toggle" class="btn btn-secondary">Dark Mode</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div style="height: 70px;"></div>

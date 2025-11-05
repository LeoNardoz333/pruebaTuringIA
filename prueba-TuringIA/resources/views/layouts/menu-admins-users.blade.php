<nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgba(148, 187, 238, 1);">
    <div class="container">
        <a class="navbar-brand text-wrap" href="{{ route('home') }}">Login - El Comal Antiguo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('v_loginAdmins') }}">Administradores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

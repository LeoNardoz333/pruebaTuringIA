<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">El Comal Antiguo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('v_menu-admins') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('categoria.index') }}">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('platillo.index') }}">Platillos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('venta.index') }}">Ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('usuario.index') }}">Usuarios</a>
        </li>
      </ul>
    </div>
    <div class="d-flex align-items-center">
      @auth
        <span class="me-3">
          👤 {{ Auth::user()->nombre }}
        </span>
        <form action="" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-primary me-2">
            Cerrar sesión
          </button>
        </form>
      @endauth

      @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
      @endguest
    </div>
  </div>
</nav>
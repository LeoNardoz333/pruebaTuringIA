<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">El Comal Antiguo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#nosotros">Acerca de nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#platillos">Platillos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contactanos">Contáctanos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#clientes">Nuestros clientes</a>
        </li>
      </ul>
    </div>
    <div class="d-flex align-items-center">
      @auth
        <span class="me-3">
          👤 {{ Auth::user()->nombre }}
        </span>
        <form action="{{ route('login.logout') }}" method="POST">
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
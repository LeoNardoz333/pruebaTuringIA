<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>El Comal Antiguo</title>
</head>
<body>
    <header>
        @include('layouts.nav_menu-admins')
    </header>
    <div class="container mt-4">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <h1>Bienvenido de Vuelta.</h1>
        </div>
        @yield('content')
    </div>
</body>
</html>
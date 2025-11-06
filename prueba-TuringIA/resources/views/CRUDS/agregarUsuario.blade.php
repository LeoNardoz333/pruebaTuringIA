<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Usuarios</title>
</head>
<body>
    @include('layouts.nav_menu-admins')

    <div class="container mt-4">
            <div class="row mx-0">
                <div class="col-lg-6 mt-4">
                    <div class="border p-4">
                        <h1 class="my-4">Agregar Usuario</h1>

                        <form action="" method="POST">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre del Usuario</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="permisos">Permisos</label>
                                <select class="form-select" id="permisos" name="permisos" required>
                                    <option value="" selected disabled>Selecciona un rol de usuario</option>
                                    <option value="user">Usuario</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="border p-4">
                        <h1 class="my-4">Usuarios Registrados</h1>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Administrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        use App\Models\User;
                                        $usuarios = User::all();
                                    @endphp

                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->nombre }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ ucfirst($usuario->permisos ?? 'usuario') }}</td>
                                            <td>
                                                <form action="{{ route('usuario.edit', ['id' => $usuario->id]) }}" method="get" class="d-inline">
                                                    <button type="submit" class="btn btn-success btn-sm">Editar</button>
                                                </form>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $usuario->id }}">Eliminar</button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-{{ $usuario->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $usuario->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modalLabel{{ $usuario->id }}">Eliminar Usuario</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar al usuario <strong>{{ $usuario->nombre }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form method="POST" action="{{ route('usuario.destroy', ['id' => $usuario->id]) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>

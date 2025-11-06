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
        {{-- FORMULARIO --}}
        <div class="col-lg-4 mt-4">
            <div class="border p-4">
                <h1 class="my-4" id="formTitle">Agregar Usuario</h1>

                <form action="{{ route('usuario.storeAdmin') }}" method="POST" id="usuarioForm">
                    @csrf
                    <input type="hidden" id="usuario_id" name="id">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="nombre">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    @error('nombre') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    @error('email') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    @error('password') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="permisos">Permisos</label>
                        <select class="form-select" id="permisos" name="permisos" required>
                            <option value="" selected disabled>Selecciona un rol de usuario</option>
                            <option value="user">Usuario</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>

                    <button type="submit" id="formSubmit" class="btn btn-primary">Añadir Usuario</button>
                </form>
            </div>
        </div>

        {{-- TABLA --}}
        <div class="col-lg-8 mt-4">
            <div class="border p-4">
                <h1 class="my-4">Usuarios Registrados</h1>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Administrar</th>
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
                                    <button type="button"
                                            class="btn btn-success btn-sm btn-editar"
                                            data-id="{{ $usuario->id }}"
                                            data-nombre="{{ $usuario->nombre }}"
                                            data-email="{{ $usuario->email }}"
                                            data-permisos="{{ $usuario->permisos }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('usuarioForm');
    const submitBtn = document.getElementById('formSubmit');
    const title = document.getElementById('formTitle');
    const passwordField = document.getElementById('password');

    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('usuario_id').value = button.dataset.id;
            document.getElementById('nombre').value = button.dataset.nombre;
            document.getElementById('email').value = button.dataset.email;
            document.getElementById('permisos').value = button.dataset.permisos;

            passwordField.removeAttribute('required');
            passwordField.value = '';

            title.textContent = "Editar Usuario";
            submitBtn.textContent = "Actualizar Usuario";

            form.action = `/CRUDS/agregarUsuario/${button.dataset.id}`;
            if (!form.querySelector('input[name="_method"]')) {
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PATCH';
                form.appendChild(methodField);
            }
        });
    });
});
</script>
</body>
</html>

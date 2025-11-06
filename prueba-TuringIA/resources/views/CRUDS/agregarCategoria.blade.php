<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Categorías</title>
</head>
<body>
    @include('layouts.nav_menu-admins')
    <div class="container mt-4">
            <div class="row mx-0">
                <div class="col-lg-6 mt-4">
                    <div class="border p-4">
                        <h1 class="my-4">Agregar Categoría</h1>
                        <form action="" method="post">
                            @csrf

                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @error('nombre')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="nombre">Nombre de la Categoría</label><br>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="border p-4">
                        <h1 class="my-4">Categorías Registradas</h1>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Administrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    use App\Models\Categoria;
                                    $categorias = Categoria::all();
                                    @endphp
                                    @foreach ($categorias as $categoria)
                                    <tr>
                                        <td>{{ $categoria->nombre }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $categoria->id }}">Eliminar</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-{{ $categoria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Categoría</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Al eliminar la categoría <strong>{{ $categoria->nombre }}</strong>, se eliminarán todos los productos que pertenezcan a ella. ¿Estás seguro de eliminar la categoría <strong>{{ $categoria->nombre }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <form method="post" action="{{ route('categorias.destroy', ['categoria' => $categoria->id]) }}">
                                                        @method('delete')
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
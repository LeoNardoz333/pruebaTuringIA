<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Platillos</title>
</head>
<body>
    @include('layouts.nav_menu-admins')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="container border p-4 mt-4">
                    <h1 class="my-4">Agregar Platillo</h1>
                    
                    <form action="{{ route('platillo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="nombre">Nombre del Platillo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fkcategoria">Categoría del Platillo</label>
                            @php
                                use App\Models\Categoria;
                                $categorias = Categoria::all();
                            @endphp
                            <select name="fkcategoria" class="form-select">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto">Foto del Platillo</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Añadir Platillo</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="container border p-4 mt-4">
                    <h1 class="my-4">Lista de Platillos</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Descripción</th>
                                    <th>Foto</th>
                                    <th>Administrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use App\Models\Platillo;
                                    $platillos = Platillo::all();
                                @endphp

                                @foreach ($platillos as $platillo)
                                    <tr>
                                        <td>{{ $platillo->nombre }}</td>
                                        <td>${{ number_format($platillo->precio, 2) }}</td>
                                        <td>{{ $platillo->descripcion }}</td>
                                        <td>
                                            @if ($platillo->foto)
                                                <a href="{{ asset('storage/' . $platillo->foto) }}" target="_blank">Ver imagen</a>
                                            @else
                                                <span class="text-muted">Sin foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('platillo.edit', $platillo->id) }}" method="GET" class="d-inline">
                                                <button type="submit" class="btn btn-success btn-sm">Editar</button>
                                            </form>
                                            <form action="{{ route('platillo.destroy', $platillo->id) }}" method="POST" class="d-inline">
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
</body>
</html>

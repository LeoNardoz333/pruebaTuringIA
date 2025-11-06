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
            <div class="col-lg-4">
                <div class="container border p-4 mt-4">
                    <h1 class="my-4">Agregar Platillo</h1>
                    
                    <form action="{{ route('platillo.store') }}" method="POST" enctype="multipart/form-data" id="platilloForm">
                        @csrf
                        <input type="hidden" id="platillo_id" name="id">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="nombre">Nombre del Platillo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            @error('nombre') <p class="text text-danger text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="categorias_id">Categoría del Platillo</label>
                            @php
                                use App\Models\Categoria;
                                $categorias = Categoria::all();
                            @endphp
                            <select name="categorias_id" class="form-select">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    @error('descripcion') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                    @error('precio') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto">Foto del Platillo</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" >
                    @error('foto') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Añadir Platillo</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
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
                                            <button type="button"
                                                class="btn btn-success btn-sm btn-editar"
                                                data-id="{{ $platillo->id }}"
                                                data-nombre="{{ $platillo->nombre }}"
                                                data-descripcion="{{ $platillo->descripcion }}"
                                                data-precio="{{ $platillo->precio }}"
                                                data-categoria="{{ $platillo->categorias_id }}">
                                                Editar
                                            </button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('platilloForm');
            const submitBtn = document.getElementById('submitBtn');

            document.querySelectorAll('.btn-editar').forEach(button => {
                button.addEventListener('click', () => {
                    // Rellenar campos
                    document.getElementById('platillo_id').value = button.dataset.id;
                    document.getElementById('nombre').value = button.dataset.nombre;
                    document.getElementById('descripcion').value = button.dataset.descripcion;
                    document.getElementById('precio').value = button.dataset.precio;
                    document.querySelector('select[name="categorias_id"]').value = button.dataset.categoria;

                    // Cambiar el título y el botón
                    document.querySelector('h1.my-4').textContent = "Editar Platillo";
                    submitBtn.textContent = "Actualizar Platillo";

                    // Cambiar la acción del formulario (PATCH)
                    form.action = `/CRUDS/agregarPlatillo/${button.dataset.id}`;
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

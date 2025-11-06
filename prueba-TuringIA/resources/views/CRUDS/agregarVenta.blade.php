<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Ventas</title>
</head>
<body>
@include('layouts.nav_menu-admins')

<div class="container-fluid">
    <div class="row">
        {{-- FORMULARIO --}}
        <div class="col-lg-4">
            <div class="container border p-4 mt-4">
                <h1 class="my-4" id="formTitle">Agregar Venta</h1>
                
                <form action="{{ route('venta.store') }}" method="POST" id="ventaForm">
                    @csrf

                    <input type="hidden" id="venta_id" name="id">
                    <input type="hidden" id="fecha_venta" name="fecha_venta" value="{{ date('Y-m-d') }}">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="platillos_id">Platillo</label>
                        @php
                            use App\Models\Platillo;
                            $platillos = Platillo::all();
                        @endphp
                        <select name="platillos_id" id="platillos_id" class="form-select">
                            @foreach ($platillos as $platillo)
                                <option value="{{ $platillo->id }}">{{ $platillo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" step="1" class="form-control" id="cantidad" name="cantidad" required>
                    @error('cantidad') <p class="text text-danger text-center">{{ $message }}</p>
                    @enderror
                    </div>

                    <button type="submit" id="formSubmit" class="btn btn-primary mt-3">Añadir Venta</button>
                </form>
            </div>
        </div>

        {{-- TABLA DE REGISTROS --}}
        <div class="col-lg-8">
            <div class="container border p-4 mt-4">
                <h1 class="my-4">Registro de Ventas</h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Platillo</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Administrar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            use Illuminate\Support\Facades\DB;
                            $ventas = DB::table('v_ventas')->get();
                        @endphp

                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->platillo }}</td>
                                <td>{{ $venta->cantidad }}</td>
                                <td>{{ $venta->fecha_venta }}</td>
                                <td>{{ $venta->total }}</td>
                                <td>
                                    <button type="button"
                                            class="btn btn-success btn-sm btn-editar"
                                            data-id="{{ $venta->id }}"
                                            data-platillo="{{ $venta->platillos_id }}"
                                            data-cantidad="{{ $venta->cantidad }}"
                                            data-fecha_venta="{{ $venta->fecha_venta }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('venta.destroy', $venta->id) }}" method="POST" class="d-inline">
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
    const form = document.getElementById('ventaForm');
    const submitBtn = document.getElementById('formSubmit');
    const title = document.getElementById('formTitle');

    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('venta_id').value = button.dataset.id;
            document.getElementById('cantidad').value = button.dataset.cantidad;
            document.getElementById('fecha_venta').value = button.dataset.fecha_venta;
            document.getElementById('platillos_id').value = button.dataset.platillo;

            title.textContent = "Editar Venta";
            submitBtn.textContent = "Actualizar Venta";

            // Cambiar la acción del formulario
            form.action = `/CRUDS/agregarVenta/${button.dataset.id}`;
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

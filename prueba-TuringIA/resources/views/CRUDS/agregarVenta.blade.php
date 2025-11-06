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
                    <h1 class="my-4">Agregar Venta</h1>
                    
                    <form action="{{ route('platillo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="nombre">Platillo</label>
                            @php
                                use App\Models\Platillo as Platillos;
                                $platillos = Platillos::all();
                            @endphp
                            <select name="platillo_id" class="form-select">
                                @foreach ($platillos as $platillo)
                                    <option value="{{ $platillo->id }}">{{ $platillo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="precio">Cantidad</label>
                            <input type="number" step="0.01" class="form-control" id="cantidad" name="cantidad" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Añadir Venta</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="container border p-4 mt-4">
                    <h1 class="my-4">Registro de Ventas</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                        <tr>
                            <th scope="col">Platillo</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                        </tr>
                            </thead>
                            <tbody>
                            @php
                                use App\Models\Venta;
                                $ventas = Venta::all();
                            @endphp
                                @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->platillo }}</td>
                                    <td>{{ $venta->cantidad }}</td>
                                    <td>{{ $venta->fecha }}</td>
                                    <td>{{ $venta->total }}</td>
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

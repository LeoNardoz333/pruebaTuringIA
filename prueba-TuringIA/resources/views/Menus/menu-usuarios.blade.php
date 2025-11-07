<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @vite(['resources/css/home.css', 'resources/js/app.js'])
    <title>El Comal Antiguo</title>
</head>
<body>
    <header>
        @include('layouts.nav_menu-users')
    </header>
    <section id="nosotros" class="banner" style="background-color: #571c05ff; color: white;">
        <div class="container-fluid py-0">
            <div class="row">
                <div class="col col-8">
                    <div class="d-flex flex-column justify-content-end h-100 ps-1"  style="padding-bottom: 80px;">
                        <h1>Acerca de Nosotros</h1>
                        <div class="col col-9">
                            <p>El Comal Antiguo es un restaurante que celebra la esencia de la comida tradicional mexicana. 
                            Con ingredientes frescos y el sabor casero que nos conecta con nuestras raíces.
                            Un lugar donde el sazón de México revive en cada bocado.</p>
                        </div>
                        <a href="#contactanos">
                            <button class="btn btn-light mt-2" style="width: 110px;">Visítanos</button>
                        </a>
                    </div>
                </div>
                <div class="col col-4 px-0">
                <img src="{{ asset('storage/blog/nosotros.jpg') }}" alt="Imagen de restaurante" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section id="platillos" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2>Nuestros Platillos</h2>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row" id="platillos-container">
                <!-- Los platillos se cargarán aquí mediante JavaScript -->
            </div>
        </div>
    </section>

    <section id="contactanos" class="py-5 banner" style="background-color: #571c05ff; color: white;">
        <div class="container-fluid ps-0">
        <div class="row">
            <div class="col col-8 text-center">
                    <div class="d-flex flex-column justify-content-center h-100">
                        <h2 class="mb-4">Contáctanos</h2>
                        <p>Puedes hacernos cualquier pedido, o venir a visitarnos.</p>
                        <p>Correo electrónico: correo@comalantiguo.com.mx</p>
                        <p>Whatsapp: +52 474#######</p>
                        <p>Dirección: Calle Democracia, Lagos de Moreno, Jalisco, México</p>
                    </div>
            </div>
                <div class="col col-4">
                    <iframe 
                        src="https://www.google.com/maps?q=21.360820,-101.936016&hl=es&z=15&output=embed"
                        width="100%" 
                        height="300" 
                        style="border:0; border-radius:10px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="clientes">
        <div class="container mt-3 py-5 my-2">
            <div class="row text-center">
                <h2 class="mb-5 pb-2">Nuestros clientes</h2>
                <div class="col-md-4 clientes">
                    <img src="{{ asset('storage/clientes/TaylorSwift.webp') }}" alt="Taylor Swift" class="cliente-img mb-3">
                    <h5 class="mb-3">Taylor</h5>
                    <p>“I never thought Mexican food could be this tasty. My favorite dish was the 'Agua de horchata´.
                    I would come again.”</p>
                </div>

                <div class="col-md-4 clientes">
                    <img src="{{ asset('storage/clientes/skrillex.jpg') }}" alt="Skrillex" class="cliente-img mb-3">
                    <h5 class="mb-3">Skrillex</h5>
                    <p>“¡La comida estaba buenísima! Puedo notar que usaron muy buenas licuadoras para prepararla.”</p>
                </div>

                <div class="col-md-4 clientes">
                    <img src="{{ asset('storage/clientes/Alfre.jpg') }}" alt="Alfre" class="cliente-img mb-3">
                    <h5 class="mb-3">Alfredo</h5>
                    <p>“La comida estaba tan buena, como el capítulo III de Silksong.”</p>
                </div>
            </div>
        </div>
    </section>


    <footer class="pt-5 pb-2 banner" style="background-color: #351103ff; color: white;">
        <div class="container text-center">
            <div class="row justify-content-center">
            <div class="col-4 d-flex justify-content-center align-items-center">
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com" target="_blank" 
                    class="btn btn-light d-flex justify-content-center align-items-center rounded-square"
                    style="width:40px; height:40px; padding:0;">
                        <img src="{{ asset('storage/icons/facebook.png') }}" 
                            alt="Facebook" style="width:60%; height:60%; object-fit:contain;">
                    </a>
                    <a href="https://www.twitter.com" target="_blank" 
                    class="btn btn-light d-flex justify-content-center align-items-center rounded-square"
                    style="width:40px; height:40px; padding:0;">
                        <img src="{{ asset('storage/icons/twitter.png') }}" 
                            alt="X" style="width:60%; height:60%; object-fit:contain;">
                    </a>

                    <a href="https://www.instagram.com" target="_blank" 
                    class="btn btn-light d-flex justify-content-center align-items-center rounded-square"
                    style="width:40px; height:40px; padding:0;">
                        <img src="{{ asset('storage/icons/instagram.png') }}" 
                            alt="Instagram" style="width:60%; height:60%; object-fit:contain;">
                    </a>
                </div>
            </div>
                <div class="col-8">
                    <div class="row text-center">
                        <div class="col-6 d-flex justify-content-center">
                            <div class="d-flex flex-column gap-3">
                                <a href="#nosotros" class="text-white text-decoration-none">Acerca de nosotros</a>
                                <a href="#platillos" class="text-white text-decoration-none">Platillos</a>
                            </div>
                        </div>
                        <div class="col-6 d-flexjustify-content-center">
                            <div class="d-flex flex-column  gap-3">
                                <a href="#contactanos" class="text-white text-decoration-none">Contáctanos</a>
                                <a href="#clientes" class="text-white text-decoration-none">Nuestros clientes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center pt-5">
        <p>&copy; 2025 El Comal Antiguo. Todos los derechos reservados.</p>
        </div>
    </footer>
    <!--- Limpiar el hash de la URL al cargar la página --->
    <script>
        window.addEventListener('load', function() {
            if (window.location.hash) {
                history.replaceState(null, null, window.location.pathname);
            }
        });

        //--- Cargar platillos desde la API ---//
        document.addEventListener('DOMContentLoaded', async () => {
            const container = document.getElementById('platillos-container');

            try {
                const response = await fetch("{{ url('/api/platillos') }}");
                const platillos = await response.json();

                platillos.forEach(platillo => {
                    const card = `
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="${platillo.foto_url}" class="card-img-top" alt="${platillo.nombre}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">${platillo.nombre}</h5>
                                        <small class="text-muted" style="font-size: 1.0rem;">${platillo.precio} USD</small>
                                    </div>
                                    <p class="card-text mt-2">${platillo.descripcion || ''}</p>
                                    <form id="comprar-form-${platillo.id}" action="/venta/store/${platillo.id}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cantidad-${platillo.id}" class="form-label">Cantidad:</label>
                                            <input type="number" name="cantidad" id="cantidad-${platillo.id}" min="1" value="1" class="form-control mb-2">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block" onclick="showAlert();">Comprar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', card);
                });

            } catch (error) {
                console.error("Error al obtener los platillos:", error);
                container.innerHTML = "<p class='text-danger text-center'>Error al cargar los platillos.</p>";
            }
        });

        function showAlert() {
        alert('¡Compra realizada correctamente!');
        }
        </script>
</body>
</html>
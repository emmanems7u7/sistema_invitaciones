@extends('layouts.argon')

@section('content')
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Panel administrativo</div>

                    <div class="card-body">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createInvitationModal">
                            Crear Invitación
                        </button>

                    </div>
                </div>
            </div>

            <div class="container mt-5">


                <!-- Verificar si hay invitaciones -->
                @if($invitaciones->isEmpty())
                    <p>No hay invitaciones para este usuario.</p>
                @else
                    <!-- Iterar sobre las invitaciones y mostrar en cards -->
                    <div class="row">
                        @foreach($invitaciones as $invitacion)
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $invitacion->tipo }}</h5>
                                        <a href=" {{route('bloques.create', [$invitacion->id])}} " class="btn btn-sm btn-success">
                                            Añadir
                                            componentes</a>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($invitacion->ubicaciones as $ubicacion)
                                                <div class="col-md-4 mb-4">
                                                    <div class="card mt-3">
                                                        <div class="card-header">
                                                            <h5 class="card-title">{{ $ubicacion->actividad }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <p><strong>Fecha:</strong> {{ $ubicacion->fecha }}</p>
                                                            <p><strong>Hora de Inicio:</strong> {{ $ubicacion->hora_inicio }}</p>
                                                            <p><strong>Dirección:</strong> {{ $ubicacion->direccion }}</p>
                                                            <p><strong>Geolocalización:</strong> {{ $ubicacion->geolocalizacion }}</p>

                                                        </div>
                                                        <div class="card-footer">
                                                            <a class="btn btn-warning"
                                                                href="{{ route('invitaciones.edit', $invitacion) }}">Editar</a>
                                                            <form action="{{ route('invitaciones.destroy', $invitacion->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Eliminar
                                                                    Invitación</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createInvitationModal" tabindex="-1" aria-labelledby="createInvitationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createInvitationForm" method="POST" action="{{ route('invitaciones.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createInvitationModalLabel">Crear Invitación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tipo -->
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Invitación</label>
                            <input type="text" class="form-control" id="tipo" name="tipo"
                                placeholder="Ejemplo: Boda, Cumpleaños" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Nombre del evento" required>
                        </div>

                        <!-- Bloque para Agregar Actividades -->
                        <h5>Actividades</h5>
                        <div class="mb-3">
                            <label for="actividad" class="form-label">Actividad</label>
                            <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Actividad">
                        </div>

                        <div class="mb-3">
                            <label for="representacion" class="form-label">Seleccione una Representación</label>
                            <select class="form-control" id="representacion" name="representacion">
                                <option value="">Seleccione...</option>
                                <option value="imagen">Imagen</option>
                                <option value="icono">Ícono</option>
                            </select>
                        </div>

                        <!-- Input para subir Imagen (oculto por defecto) -->
                        <div class="mb-3" id="imagenContainer" style="display: none;">
                            <label for="imagen" class="form-label">Subir Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                        </div>

                        <!-- Input para seleccionar Ícono (oculto por defecto) -->
                        <div class="mb-3" id="iconoContainer" style="display: none;">
                            <label for="icono" class="form-label">Seleccionar Ícono</label>
                            <input type="text" class="form-control" id="icono" name="icono"
                                placeholder="Ejemplo: fas fa-star">
                            <div id="iconPreview" class="mt-2" style="font-size: 24px;"></div>
                        </div>



                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>

                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio">
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                placeholder="Ingrese la dirección">
                        </div>

                        <!-- Geolocalización -->
                        <div class="mb-3">
                            <label for="geolocalizacion" class="form-label">Geolocalización</label>
                            <input type="text" class="form-control" id="geolocalizacion" name="geolocalizacion"
                                placeholder="Seleccione una ubicación en el mapa" readonly>
                            <div id="map" style="height: 300px; margin-top: 10px;"></div>
                        </div>

                        <div id="actividadesContainer">


                        </div>
                        <button type="button" class="btn btn-success mt-2" id="addActivityButton">Agregar Actividad</button>



                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="{{$user_id}} ">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Invitación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('representacion').addEventListener('change', function () {
            let seleccion = this.value;
            let imagenContainer = document.getElementById('imagenContainer');
            let iconoContainer = document.getElementById('iconoContainer');

            if (seleccion === "imagen") {
                imagenContainer.style.display = "block";
                iconoContainer.style.display = "none";
            } else if (seleccion === "icono") {
                imagenContainer.style.display = "none";
                iconoContainer.style.display = "block";
            } else {
                imagenContainer.style.display = "none";
                iconoContainer.style.display = "none";
            }
        });

        // Vista previa del ícono en tiempo real
        document.getElementById('icono').addEventListener('input', function () {
            let icono = this.value.trim();
            let iconPreview = document.getElementById('iconPreview');
            if (icono) {
                iconPreview.innerHTML = `<i class="${icono}"></i>`;
            } else {
                iconPreview.innerHTML = "";
            }
        });
    </script>


    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <!-- JS de Leaflet Control Geocoder -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicialización del mapa con coordenadas de La Paz, Bolivia
            const map = L.map('map').setView([-16.5000, -68.1193], 13); // Coordenadas de La Paz

            // Capa base de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Agregar el Control de Geocoder (Buscador de Direcciones)
            L.Control.geocoder({
                defaultMarkGeocode: false, // Evita que el buscador coloque un marcador automáticamente
            }).on('markgeocode', function (e) {
                var latlng = e.geocode.center;
                marker.setLatLng(latlng); // Mueve el marcador a la ubicación encontrada
                map.setView(latlng, 13); // Centra el mapa en la ubicación
                document.getElementById('geolocalizacion').value = latlng.lat + ', ' + latlng.lng; // Actualiza el campo de geolocalización
            }).addTo(map);

            // Crear un marcador en la ubicación predeterminada (La Paz, Bolivia)
            let marker = L.marker([-16.5000, -68.1193], { draggable: true }).addTo(map);

            // Actualizar el input de geolocalización al mover el marcador
            marker.on('dragend', function (e) {
                const latLng = marker.getLatLng();
                document.getElementById('geolocalizacion').value = `${latLng.lat}, ${latLng.lng}`;
            });

            // Hacer clic en el mapa para mover el marcador
            map.on('click', function (e) {
                const latLng = e.latlng;
                marker.setLatLng(latLng);
                document.getElementById('geolocalizacion').value = `${latLng.lat}, ${latLng.lng}`;
            });

            // Redibujar el mapa al abrir el modal
            $('#createInvitationModal').on('shown.bs.modal', function () {
                map.invalidateSize(); // Esto fuerza a Leaflet a recalcular el tamaño del mapa después de abrir el modal
            });


            map.on('resize', function () {
                map.invalidateSize(); // Recalcula el tamaño para evitar espacios vacíos
            });
        });
    </script>

    <script>

        document.addEventListener("DOMContentLoaded", function () {
            var actividades = [];

            document.getElementById("addActivityButton").addEventListener("click", function () {
                const actividad = document.getElementById("actividad").value;
                const fecha = document.getElementById("fecha").value;
                const icono = document.getElementById("icono").value; // Valor del icono seleccionado
                const imagenInput = document.getElementById("imagen"); // Input tipo file

                const horaInicio = document.getElementById("hora_inicio").value;
                const direccion = document.getElementById("direccion").value;
                const geolocalizacion = document.getElementById("geolocalizacion").value;

                if (actividad && fecha && horaInicio && direccion) {
                    let nuevaActividad = {
                        actividad,
                        fecha,
                        horaInicio,
                        direccion,
                        geolocalizacion,
                        icono: icono || null,
                        imagen: null,
                    };

                    // Si se ha seleccionado una imagen, guardarla como un objeto File
                    if (imagenInput.files.length > 0) {
                        nuevaActividad.imagen = imagenInput.files[0];
                    }

                    // Agregar al array
                    actividades.push(nuevaActividad);
                    actualizarListaActividades();
                    limpiarCampos();
                } else {
                    alert("Por favor, complete todos los campos antes de agregar la actividad.");
                }
            });;

            function actualizarListaActividades() {
                const contenedor = document.getElementById("actividadesContainer");
                contenedor.innerHTML = "";

                actividades.forEach((act, index) => {
                    const div = document.createElement("div");
                    div.classList.add("alert", "alert-info", "d-flex", "justify-content-between", "align-items-center");

                    let vistaPrevia = "";

                    if (act.icono) {
                        // Si es un icono, mostrarlo con FontAwesome
                        vistaPrevia = `<i class="${act.icono} fa-2x me-2"></i>`;
                    } else if (act.imagen) {
                        // Si es una imagen, mostrarla en miniatura
                        const imagenURL = URL.createObjectURL(act.imagen);
                        vistaPrevia = `<img src="${imagenURL}" alt="Imagen" class="img-thumbnail me-2" style="width: 50px; height: 50px;">`;
                    }

                    div.innerHTML = `
                                                    <div class="d-flex align-items-center">
                                                        ${vistaPrevia}
                                                        <span><strong>${act.actividad}</strong> - ${act.fecha} ${act.horaInicio} - ${act.direccion}</span>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarActividad(${index})">Eliminar</button>
                                                `;

                    contenedor.appendChild(div);

                });
                console.log(actividades);
            }

            window.eliminarActividad = function (index) {
                actividades.splice(index, 1);
                actualizarListaActividades();
            };

            function limpiarCampos() {
                document.getElementById("actividad").value = "";
                document.getElementById("fecha").value = "";
                document.getElementById("hora_inicio").value = "";
                document.getElementById("direccion").value = "";
                document.getElementById("geolocalizacion").value = "";
            }

            document.getElementById("createInvitationForm").addEventListener("submit", function (event) {
                const actividadesInput = document.createElement("input");
                actividadesInput.type = "hidden";
                actividadesInput.name = "actividades";
                actividadesInput.value = JSON.stringify(actividades);
                this.appendChild(actividadesInput);
            });
        });

    </script>
@endsection
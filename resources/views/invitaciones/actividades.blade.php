<script>

    function actualizar_selector() {
        let seleccion = document.getElementById('representacion').value;
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
    }

    // Ejecutar al cargar la página si hay un valor seleccionado
    document.addEventListener('DOMContentLoaded', actualizar_selector);
</script>
<form id="editInvitationForm" method="POST" action="{{ route('ubicaciones.update', $ubicacion?->id ?? 0) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ERRORES GLOBALES --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="actividad" class="form-label">Actividad</label>
                <input type="text" class="form-control" id="actividad" name="actividad"
                    value="{{ old('actividad', $ubicacion?->actividad) }}">
                @error('actividad')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        @php
            $selected = '';
            if (!empty($ubicacion?->imagen) && empty($ubicacion?->icono)) {
                $selected = 'imagen';
            } elseif (!empty($ubicacion?->icono) && empty($ubicacion?->imagen)) {
                $selected = 'icono';
            }
        @endphp

        <div class="col-md-6">
            <div class="mb-3">
                <label for="representacion" class="form-label">Seleccione una Representación</label>
                <select class="form-control" id="representacion" name="representacion" onchange="actualizar_selector()">
                    <option value="">Seleccione...</option>
                    <option value="imagen" {{ old('representacion', $selected) == 'imagen' ? 'selected' : '' }}>Imagen
                    </option>
                    <option value="icono" {{ old('representacion', $selected) == 'icono' ? 'selected' : '' }}>Ícono
                    </option>
                </select>
                @error('representacion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="mb-3" id="imagenContainer"
        style="display: {{ (old('representacion', $selected) == 'imagen') ? 'block' : 'none' }};">
        <label for="imagen" class="form-label">Subir Imagen</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        @if(!empty($ubicacion?->imagen))
            <img src="{{ asset('storage/' . $ubicacion->imagen) }}" alt="Imagen actual" class="mt-2"
                style="max-height: 100px;">
        @endif
        @error('imagen')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3" id="iconoContainer"
        style="display: {{ (old('representacion', $selected) == 'icono') ? 'block' : 'none' }};">
        <label for="icono" class="form-label">Seleccionar Ícono</label>
        <input type="text" class="form-control" id="icono" name="icono" value="{{ old('icono', $ubicacion?->icono) }}"
            placeholder="Ejemplo: fas fa-star">
        <div id="iconPreview" class="mt-2" style="font-size: 24px;">
            @if(!empty($ubicacion?->icono))
                <i class="{{ $ubicacion->icono }}"></i>
            @endif
        </div>
        @error('icono')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha"
                    value="{{ old('fecha', $ubicacion?->fecha) }}">
                @error('fecha')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio"
                    value="{{ old('hora_inicio', $ubicacion?->hora_inicio) }}">
                @error('hora_inicio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ old('direccion', $ubicacion?->direccion) }}">
                @error('direccion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="geolocalizacion" class="form-label">Geolocalización</label>
                <input type="text" class="form-control" id="geolocalizacion" name="geolocalizacion"
                    value="{{ old('geolocalizacion', $ubicacion?->geolocalizacion) }}" readonly>
                @error('geolocalizacion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div id="map" style="height: 300px; margin-top: 10px;"></div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <a href="{{ route('invitaciones.index') }}" class="btn btn-secondary">Cancelar</a>
</form>


<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<!-- JS de Leaflet Control Geocoder -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @php
            $defaultLatLng = '-16.5000, -68.1193';
            $geo = $ubicacion->geolocalizacion ?? $defaultLatLng;
            [$lat, $lng] = explode(',', $geo);
        @endphp

        const lat = parseFloat('{{ trim($lat) }}');
        const lng = parseFloat('{{ trim($lng) }}');

        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.Control.geocoder({
            defaultMarkGeocode: false,
        }).on('markgeocode', function (e) {
            var latlng = e.geocode.center;
            marker.setLatLng(latlng);
            map.setView(latlng, 13);
            document.getElementById('geolocalizacion').value = latlng.lat + ', ' + latlng.lng;
        }).addTo(map);

        let marker = L.marker([lat, lng], { draggable: true }).addTo(map);

        marker.on('dragend', function () {
            const latLng = marker.getLatLng();
            document.getElementById('geolocalizacion').value = `${latLng.lat}, ${latLng.lng}`;
        });

        map.on('click', function (e) {
            const latLng = e.latlng;
            marker.setLatLng(latLng);
            document.getElementById('geolocalizacion').value = `${latLng.lat}, ${latLng.lng}`;
        });

        $('#createInvitationModal').on('shown.bs.modal', function () {
            map.invalidateSize();
        });

        map.on('resize', function () {
            map.invalidateSize();
        });
    });
</script>
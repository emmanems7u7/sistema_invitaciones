@foreach ($ubicaciones as $ubicacion)
    <div class="col-md-4 mb-4">
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">{{ $ubicacion->actividad }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Fecha:</strong> {{ $ubicacion->fecha }}</p>
                <p><strong>Hora de Inicio:</strong>
                    {{ $ubicacion->hora_inicio }}
                </p>
                <p><strong>Dirección:</strong> {{ $ubicacion->direccion }}
                </p>
                <p><strong>Geolocalización:</strong>
                    {{ $ubicacion->geolocalizacion }}
                </p>

            </div>
        </div>
    </div>

@endforeach
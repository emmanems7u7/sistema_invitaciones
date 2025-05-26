@extends('layouts.argon')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Editar Invitación</h2>

                <form id="editInvitationForm" method="POST" action="{{ route('invitaciones.update', $invitacion->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tipo -->
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Invitación</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $invitacion->tipo }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $invitacion->nombre }}"
                            required>
                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $invitacion->user_id }}">

                    <button type="submit" class="btn btn-primary">Actualizar Invitación</button>
                    <a href="{{ route('invitaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>

                <!-- Actividad -->


                <div class="row g-2 mt-3 mb-3">
                    <div class="col-md-6">
                        <h5 class="mt-4">Actividades</h5>
                        <div class="row">


                            @foreach ($invitacion->ubicaciones as $actividad)
                                <div class="col-md-12">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body p-2 d-flex align-items-start gap-2">
                                            @if ($actividad->icono)
                                                <i class="{{ $actividad->icono }} fa-2x text-secondary"></i>
                                            @elseif ($actividad->imagen)
                                                <img src="{{ asset('storage/ubicaciones/' . $actividad->imagen) }}" alt="img"
                                                    class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $actividad->actividad }}</h6>
                                                <small class="text-muted d-block">{{ $actividad->fecha }} –
                                                    {{ $actividad->hora_inicio }}</small>
                                                <small class="d-block"><i
                                                        class="fas fa-map-marker-alt me-1 text-danger"></i>{{ $actividad->direccion }}</small>
                                                @if ($actividad->geolocalizacion)
                                                    <small class="text-muted d-block">{{ $actividad->geolocalizacion }}</small>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group">
                                                <a href="{{ route('ubicaciones.edit', $actividad) }}"
                                                    class="btn btn-outline-warning me-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('ubicaciones.destroy', $actividad) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger"
                                                        onclick="return confirm('¿Eliminar esta actividad?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col md-6">

                        @if(!empty($ubicacion))
                            <h5 class="mt-4">Editar actividad</h5>
                            @include('invitaciones.actividades')
                        @endif
                    </div>
                </div>




            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script>



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
@endsection
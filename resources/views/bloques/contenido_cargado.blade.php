@if($mensajes->isNotEmpty())
    @foreach ($mensajes as $mensaje)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Mensaje de {{ $mensaje->nombre }}</h5>
                    <form action="{{ route('mensajes.destroy', $mensaje->id) }}" method="POST"
                        onsubmit="return confirm('¿Está seguro de eliminar este mensaje?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar mensaje">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    <p class="card-text">{{ $mensaje->mensaje }}</p>
                    <p class="text-muted small mb-3">Contenido cargado</p>

                    @if ($mensaje->multimedia->count())
                        <div id="galeria-{{ $mensaje->id }}" class="row g-2">
                            @foreach ($mensaje->multimedia as $archivo)
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $archivo->ruta) }}" alt="{{ $archivo->nombre }}"
                                        class="img-fluid rounded border" loading="lazy" />
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted"><em>No hay archivos multimedia asociados.</em></p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No hay multimedia cargada</p>
@endif
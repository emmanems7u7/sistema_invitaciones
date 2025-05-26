<h3>Multimedia </h3>
<div class="row" id="addedMultimedia_{{ $bloque->id }}">

    @if($bloque->multimedias->isEmpty())
        <p>No hay Multimedia para este bloque.</p>
    @else
        @foreach ($bloque->multimedias as $media)
            <div class="col-md-3 mb-3">
                <div class="media-item position-relative">
                    @if ($media->tipo === 'imagen')
                        <!-- Imagen con botón de eliminar -->
                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" aria-label="Eliminar"
                            onclick="eliminarMultimedia({{'storage/' . $media->id }}, this)">
                            &times;
                        </button>
                        <img src="{{ asset('storage/' . $media->ruta) }}" alt="Imagen de multimedia" class="img-fluid rounded">
                    @elseif ($media->tipo == 'video')
                        <!-- Video con botón de eliminar -->
                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" aria-label="Eliminar"
                            onclick="eliminarMultimedia({{ $media->id }}, this)">
                            &times;
                        </button>
                        <video controls class="img-fluid rounded">
                            <source src="{{ asset('storage/' . $media->ruta) }}" type="{{ $media->tipo }}">
                            Tu navegador no soporta videos.
                        </video>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
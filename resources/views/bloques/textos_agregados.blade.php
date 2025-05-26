<h3>Textos Agregados</h3>
<div>
    <div class="row" id="addedTexts_{{ $bloque->id }}">
        @if($bloque->textos->isEmpty())
            <p>No hay textos para este bloque.</p>
        @else

            @foreach ($bloque->textos as $texto)
                <div class="col-md-6 mb-4">
                    <div class="card mb-3">

                        <div class="card-body">
                            <h5 class="card-title">{{$texto->tipo}}</h5>
                            <p class="card-text">{{$texto->contenido}}</p>
                            <!-- Formulario para Eliminar (POST con _method DELETE) -->
                            <form action="{{ route('textos.destroy', $texto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>

                            <!-- Botón para Editar, abrir el modal con los datos del texto -->
                            <button type="button" class="btn btn-warning"
                                onclick="openEditModal({{ $texto->id }})">Editar</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
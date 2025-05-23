@extends('layouts.argon')

@section('content')
    <style>
        #bloques-container {
            display: block;
        }
    </style>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Panel administrativo</div>

                    <div class="card-body">
                        <div class="row g-2">
                            <!-- Vista previa y generación -->
                            <div class="col-md-4">
                                <a href="{{ route('invitacion.ver', ['id' => $id]) }}" class="btn btn-primary w-100"
                                    target="_blank">
                                    Vista previa de la página
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('invitacion.generar', ['id' => Crypt::encrypt($id)]) }}"
                                    class="btn btn-primary w-100" target="_blank">
                                    Generar Invitación
                                </a>
                            </div>

                            <!-- Crear Bloque y Textura -->
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#createBlockModal">
                                    Crear Bloque
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#crearTexturaModal">
                                    Crear Textura
                                </button>
                            </div>

                            <!-- Selección de colores y tipo de letra -->
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" onclick="coloresCrear()">
                                    Seleccionar Colores
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#addTipoLetraModal" onclick="crearTipoLetra()">
                                    Agregar Tipo de Letra
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal fuentes -->
            @include('bloques.modal_fuentes')
            <!-- Fin Modal fuentes -->

            <div class="card mt-3">
                <div class="card-body">
                    <div class="container my-5">
                        <h2 class="text-center mb-5" style="font-family: 'Roboto', sans-serif; color: #333;">Colores y Tipos
                            de
                            Letra para Invitaciones</h2>

                        <!-- Fila que contiene ambas secciones -->
                        <div class="row g-4">

                            <!-- Columna para los colores asociados -->
                            <div class="col-md-6">
                                <h4 class="text-center mb-4" style="font-family: 'Roboto', sans-serif; color: #555;">Colores
                                    Asociados a la Invitación</h4>
                                <div class="row">
                                    @foreach($colores as $color)
                                        <div class="col-md-6 mb-4">
                                            <div class="card shadow-lg border-0 rounded-3" style="background-color: #f8f9fa;">
                                                <div class="card-body d-flex align-items-center">
                                                    <!-- Círculo de color -->
                                                    <div class="flex-shrink-0 me-3  align-items-center justify-content-center"
                                                        style="width: 50px; height: 50px; border-radius: 50%; background-color: {{ $color->codigo }};">
                                                    </div>

                                                    <!-- Contenido de la tarjeta -->

                                                    <h5 class="card-title mb-1" style="color: #333; font-weight: 600;">
                                                        {{ $color->tipo }}
                                                    </h5>


                                                </div>
                                                <div class="card-footer">

                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="editarColor({{ $color->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('colores.destroy', $color->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>


                                    @endforeach
                                </div>
                            </div>

                            <!-- Columna para los tipos de letra -->
                            <div class="col-md-6">
                                <h4 class="text-center mb-4" style="font-family: 'Roboto', sans-serif; color: #555;">Tipos
                                    de Letra
                                    para Invitaciones</h4>
                                <div class="row">
                                    @foreach ($fuentes as $tipoLetra)
                                        <div class="col-md-6 col-sm-12 mb-4">
                                            <div class="card shadow-lg border-0 rounded-3" style="background-color: #f8f9fa;">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title" style="color: #333; font-weight: 600;">
                                                        {{ $tipoLetra->tipo }}
                                                    </h5>
                                                    <p class="card-text"
                                                        style="font-family: '{{ $tipoLetra->fuente }}', sans-serif; font-size: 16px; color: #666;">
                                                        {{ $tipoLetra->fuente }}
                                                    </p>

                                                </div>
                                                <div class="card-body">

                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#addTipoLetraModal"
                                                        onclick="editTipoLetra({{ $tipoLetra->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('fuentes.destroy', $tipoLetra->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="container mt-5">

                        <!-- Verificar si hay bloques -->
                        @if($bloques->isEmpty())
                            <p>No hay bloques para esta invitación.</p>
                        @else
                            <!-- Iterar sobre los bloques y mostrar en cards -->
                            <div class="row">
                                <h2>Bloques de la Invitación</h2>
                                <div class="col-md-8">
                                    <div id="bloques-container">
                                        @foreach($bloques as $bloque)

                                            <div class="col-md-12 mb-4 mt-2 bloque-item" data-id="{{ $bloque->id }}">
                                                <div class="card">
                                                    <div
                                                        class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <!-- Botón de colapso con icono -->
                                                        <button
                                                            class="btn btn-link text-black text-start fw-bold d-flex align-items-center"
                                                            data-bs-toggle="collapse" data-bs-target="#bloque-{{ $bloque->id }}">
                                                            <i class="fas fa-folder-open me-2"></i> {{ $bloque->tipo }}
                                                            <i class="fas fa-chevron-down ms-2"></i>
                                                        </button>
                                                        <i class="fas fa-arrows-alt drag-handle" style="cursor: grab;"></i>
                                                        <!-- Posición alineada completamente a la derecha -->
                                                        <p class="mb-0 ms-auto bloque-posicion"
                                                            id="posicion-bloque-{{ $bloque->id }}">
                                                            <strong>Posición:</strong> {{ $bloque->posicion }}
                                                        </p>

                                                    </div>

                                                    <div id="bloque-{{ $bloque->id }}" class="card-body collapse hide">


                                                        <p><strong>Fecha de Creación:</strong> {{ $bloque->created_at }}</p>
                                                        <p><strong>posicion</strong> {{ $bloque->posicion }}</p>

                                                        @if($bloque->tipo != 'ubicacion')
                                                            <button class="btn btn-primary"
                                                                onclick="openModal_texto({{ $bloque->id }})">Agregar
                                                                Texto</button>
                                                            <button class="btn btn-primary"
                                                                onclick="openMultimediaModal({{ $bloque->id }})">Agregar
                                                                multimedia</button>

                                                            <button class="btn btn-primary"
                                                                onclick="openPlantillaModal({{ $bloque->id }})">Seleccionar
                                                                Plantilla</button>

                                                            <button class="btn btn-primary"
                                                                onclick="openTexturaModal({{ $bloque->id }})">Agregar
                                                                Textura</button>

                                                            <div id="texturas" class="mt-4">
                                                                <h6>Textura</h6>
                                                                @if($bloque->textura)
                                                                    <img src="{{ asset('storage/' . $bloque->textura->textura) }}" alt=""
                                                                        style="width: 20%;">
                                                                    <form
                                                                        action="{{ route('textura.eliminar', ['bloque' => $bloque->id]) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-warning"
                                                                            onclick="return confirm('¿Estás seguro de eliminar esta textura?')">
                                                                            Eliminar textura
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <span class="text-muted">Sin textura asignada</span>
                                                                @endif
                                                            </div>

                                                            <div id="textsContainer_{{ $bloque->id }}" class="mt-4">
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
                                                                                            <form
                                                                                                action="{{ route('textos.destroy', $texto->id) }}"
                                                                                                method="POST" style="display:inline;">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Eliminar</button>
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
                                                            </div>
                                                            <div id="mediaContainer_{{ $bloque->id }}">
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
                                                                                        <button
                                                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                                                                            aria-label="Eliminar"
                                                                                            onclick="eliminarMultimedia({{'storage/' . $media->id }}, this)">
                                                                                            &times;
                                                                                        </button>
                                                                                        <img src="{{ asset('storage/' . $media->ruta) }}"
                                                                                            alt="Imagen de multimedia" class="img-fluid rounded">
                                                                                    @elseif ($media->tipo == 'video')
                                                                                        <!-- Video con botón de eliminar -->
                                                                                        <button
                                                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                                                                            aria-label="Eliminar"
                                                                                            onclick="eliminarMultimedia({{ $media->id }}, this)">
                                                                                            &times;
                                                                                        </button>
                                                                                        <video controls class="img-fluid rounded">
                                                                                            <source src="{{ asset('storage/' . $media->ruta) }}"
                                                                                                type="{{ $media->tipo }}">
                                                                                            Tu navegador no soporta videos.
                                                                                        </video>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row">
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
                                                            </div>

                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h2>Añadir Invitados</h2>
                                    @include('invitados.create', ['invitacion' => $id])
                                    <form action="{{ route('invitados.importar', $id) }}" method="POST"
                                        enctype="multipart/form-data" class="mb-3">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="archivo" class="form-label">Selecciona archivo Excel</label>
                                            <input class="form-control" type="file" id="archivo" name="archivo"
                                                accept=".xlsx,.xls,.csv" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Importar Invitados</button>
                                    </form>

                                    @include('invitados.index', ['invitacion' => $id])



                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal colores -->
    <!-- Modal reutilizable para crear y editar -->
    <div class="modal fade" id="colorModal" tabindex="-1" role="dialog" aria-labelledby="colorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="colorModalLabel">Selecciona Tres Colores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createColorForm" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="color">Selecciona un color</label>
                            <input type="color" class="form-control" id="codigo" name="codigo" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo de color</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="fondo">Fondo</option>
                                <option value="primario">Primario</option>
                                <option value="secundario">Secundario</option>
                                <option value="hover">Hover</option>
                                <option value="borde">Borde</option>
                            </select>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>

                        <input type="hidden" name="invitacion_id" id="invitacion_id" value="{{$id}}">
                        <input type="hidden" name="color_id" id="color_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="saveColorsBtn">Guardar Colores</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal texto -->
    <div class="modal" tabindex="-1" role="dialog" id="textModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Agregar Texto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="textForm">
                        @csrf
                        <div id="textFieldsContainer"></div>

                        <!-- Campo para seleccionar el bloque -->
                        <input type="hidden" id="bloque_id" name="bloque_id">

                        <button type="button" class="btn btn-primary" onclick="addTextField()">Agregar Texto</button>
                        <button type="button" class="btn btn-success" onclick="submitTextForm()">Guardar Textos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para añadir multimedia -->
    <div class="modal" tabindex="-1" role="dialog" id="multimediaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir Multimedia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="multimediaForm" enctype="multipart/form-data">
                        @csrf

                        <!-- Campo para seleccionar tipo de multimedia -->
                        <div class="form-group">
                            <label for="tipo">Tipo de Multimedia</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="imagen">Imagen</option>
                                <option value="video">Video</option>
                                <option value="audio">Audio</option>
                            </select>
                        </div>

                        <!-- Campo para seleccionar archivos (imágenes o videos) -->
                        <div class="form-group">
                            <label for="archivos">Seleccionar Archivos</label>
                            <input type="file" class="form-control" id="archivos" name="archivos[]" multiple required>
                        </div>

                        <!-- Previsualización de archivos -->
                        <div class="form-group" id="previsualizacion">
                            <!-- Las previsualizaciones se agregarán aquí -->
                        </div>

                        <!-- Campo oculto para el bloque_id -->
                        <input type="hidden" id="bloque_id_imagen" name="bloque_id">

                        <button type="button" class="btn btn-primary" id="boton_accion_imagen"
                            onclick="submitMultimediaForm()">Añadir
                            Multimedia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createBlockModal" tabindex="-1" aria-labelledby="createBlockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createBlockForm" method="POST" action=" {{route('bloques.store')}} "
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBlockModalLabel">Crear Bloque</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tipo de Bloque -->
                        <div class="mb-3">
                            <label for="tipo_bloque" class="form-label">Tipo de Bloque</label>
                            <select class="form-select" id="tipo_bloque" name="tipo_bloque" required
                                onchange="handleTipoChange()">
                                <option value="" selected disabled>Selecciona un tipo</option>
                                @foreach ($contenidos as $contenido)
                                    <option value="{{ $contenido->identificador }}">{{ $contenido->contenido }}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="componente" class="form-label">componente de Bloque</label>
                            <select class="form-select" id="componente" name="componente" required>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="posicion" class="form-label">Posición del Bloque</label>
                            <input type="number" class="form-control" id="posicion" name="posicion" min="1" step="1"
                                required placeholder="Ingresa la posición del bloque">
                        </div>
                        <input type="hidden" name="invitacion_id" id="invitacion_id" value="{{$id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Bloque</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para crear plantilla-->
    <div class="modal fade" id="seleccionarPlantillaModal" tabindex="-1" aria-labelledby="seleccionarPlantillaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seleccionarPlantillaLabel">Seleccionar Plantilla</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="plantillaForm" action="{{ route('bloque.componente') }} " method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div id="radioContainer"></div>
                            <input type="hidden" name="bloque_plantilla_id" id="bloque_plantilla_id">
                            <input type="hidden" name="plantillaSeleccionada" id="plantillaSeleccionada">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FIN Modal para crear plantilla-->

    <!-- Modal para agregar textura-->
    <div class="modal fade" id="agregarTexturaModal" tabindex="-1" aria-labelledby="agregarTexturaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarTexturaLabel">Agregar Textura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="TexturaForm" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div id="texturas_container" class=""></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FIN Modal para agregar textura-->

    <!-- Modal para crear textura-->
    <div class="modal fade" id="crearTexturaModal" tabindex="-1" aria-labelledby="crearTexturaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTexturaLabel">crear Textura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <form id="TexturaForm" action="{{ route('bloque.textura', ['id' => $id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="archivos" class="form-label">Seleccionar Texturas (imágenes)</label>
                            <input type="file" class="form-control" name="archivos[]" id="archivos" multiple
                                accept="image/*">
                        </div>

                        <div id="previewContainer" class="d-flex gap-3 flex-wrap"></div>

                        <button type="submit" class="btn btn-primary mt-3">Subir Imágenes</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('archivos').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // Limpia las previas anteriores

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '100px';
                    img.style.borderRadius = '8px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ccc';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    <!-- FIN Modal para agregar textura-->


    <script>

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.card-header button').forEach(btn => {
                btn.addEventListener('click', function () {
                    let icon = this.querySelector('.fa-chevron-down');
                    icon.classList.toggle('fa-rotate-180');
                });
            });
        });

    </script>

    <script>



        let textArray = [];

        // Función para cerrar el modal y limpiar el formulario
        function closeModal() {
            $('#textModal').modal('hide');
            $('#textForm')[0].reset();
        }


        let tiposDisponibles = ['Titulo', 'Subtitulo', 'Parrafo'];  // Array que guarda los tipos disponibles

        function addTextField() {
            // Hacemos una copia de tiposDisponibles para usarla en esta función
            const tiposRestantes = tiposDisponibles.filter(tipo => !textArray.some(item => item.tipo === tipo));

            if (tiposRestantes.length === 0) {
                alert('Ya has agregado todos los tipos de texto disponibles.');
                return;
            }

            // Crear el nuevo campo de texto para el tipo restante
            const nuevoTipo = tiposRestantes[0]; // Usamos el primer tipo disponible
            const campoHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="form-group" id="campo_${nuevoTipo}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <label for="content_${nuevoTipo}">Contenido para ${nuevoTipo}</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <textarea class="form-control" id="content_${nuevoTipo}" name="contenido_${nuevoTipo}" rows="4" required></textarea>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <input type="hidden" name="tipo_${nuevoTipo}" value="${nuevoTipo}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <button type="button" class="btn btn-danger" onclick="removeTextField('${nuevoTipo}')">Eliminar ${nuevoTipo}</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `;

            // Agregar el nuevo campo al contenedor
            $('#textFieldsContainer').append(campoHTML);

            // Añadir el tipo al array textArray para evitar que se repita
            textArray.push({ tipo: nuevoTipo, contenido: '' });
        }

        // Función para eliminar un campo de texto
        function removeTextField(tipo) {
            // Eliminar el campo del DOM
            $(`#campo_${tipo}`).remove();

            // Eliminar el tipo del array
            textArray = textArray.filter(item => item.tipo !== tipo);
        }



        function coloresCrear() {

            const form = document.getElementById('createColorForm');
            const methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'POST');  // Indica que la solicitud es PUT

            // Agregar el campo _method al formulario
            form.appendChild(methodInput);
            document.getElementById('createColorForm').method = 'POST';
            document.getElementById('createColorForm').action = "{{ route('colores.store') }}";
            $('#colorModal').modal('show');

        }

        function editarColor(id) {

            fetch(`/colores/${id}/edit`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById('codigo').value = data.colores.codigo;
                    document.getElementById('tipo').value = data.colores.tipo;
                    document.getElementById('color_id').value = data.colores.id;
                    document.getElementById('colorModalLabel').innerText = 'Editar Color';

                    $('#colorModal').modal('show');
                })
                .catch(error => console.error('Error al obtener el color:', error));

            const form = document.getElementById('createColorForm');
            const methodInput = document.createElement('input');

            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PUT');  // Indica que la solicitud es PUT
            document.getElementById('createColorForm').method = 'POST';
            // Agregar el campo _method al formulario
            form.appendChild(methodInput);

            // Cambiar la acción del formulario para actualizar el color
            form.action = "{{ route('colores.update', ['id' => '__id__']) }}".replace('__id__', id);

        }

        function eliminarColor(id) {
            // Lógica para eliminar color
            if (confirm('¿Estás seguro de que deseas eliminar este color?')) {
                window.location.href = '/colores/eliminar/' + id;
            }
        }
    </script>

    <script>
        // Función para abrir el modal de edición
        function openEditModal(textId) {
            // Obtener los datos del texto seleccionado a través de AJAX
            fetch(`/textos/${textId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Llenar el formulario con los datos del texto
                    document.getElementById('modalTitle').textContent = 'Editar Texto'; // Cambiar el título del modal
                    document.getElementById('type').value = data.texto.tipo; // Tipo de texto
                    document.getElementById('content').value = data.texto.contenido; // Contenido del texto
                    document.getElementById('bloque_id').value = data.texto.bloque_id; // ID del bloque

                    // Cambiar la acción del botón para actualizar en lugar de agregar
                    document.getElementById('boton_accion').textContent = 'Actualizar Texto';
                    document.getElementById('boton_accion').setAttribute('onclick', `updateTextForm(${textId})`);
                    const methodInput = document.createElement('input');
                    const form = document.getElementById('textForm');
                    methodInput.setAttribute('type', 'hidden');
                    methodInput.setAttribute('name', '_method');
                    methodInput.setAttribute('value', 'PUT');  // Indica que la solicitud es PUT

                    // Agregar el campo _method al formulario
                    form.appendChild(methodInput);
                    // Abrir el modal
                    $('#textModal').modal('show');
                })
                .catch(error => console.error('Error al obtener el texto:', error));
        }

        // Función para abrir el modal y enviar el id del bloque
        function openModal_texto(bloqueId) {
            document.getElementById('bloque_id').value = bloqueId;
            $('#textModal').modal('show');  // Usando Bootstrap Modal
        }

        // Función para cerrar el modal


        // Función para manejar el envío del formulario con AJAX
        function submitTextForm() {


            const bloque_id = document.getElementById('bloque_id').value;
            const token = document.querySelector('input[name="_token"]').value;




            const tiposDisponibles = ['Titulo', 'Subtitulo', 'Parrafo'];
            let todoLleno = true; // Variable para controlar si todos los campos están llenos

            // Recorremos los tipos disponibles y actualizamos el contenido en textArray
            tiposDisponibles.forEach(tipo => {
                const contenido = $(`#content_${tipo}`).val();  // Obtenemos el contenido del textarea correspondiente
                if (contenido) {
                    // Encontramos el tipo en textArray y actualizamos su contenido
                    const tipoExistente = textArray.find(item => item.tipo === tipo);
                    if (tipoExistente) {
                        tipoExistente.contenido = contenido;  // Actualizamos el contenido
                    }
                } else {
                    // Si el contenido está vacío, marcamos todoLleno como false
                    todoLleno = false;
                    $(`#content_${tipo}`).addClass('is-invalid');  // Añadimos una clase para resaltar el campo vacío
                }
            });


            // Si todos los campos están llenos, podemos proceder con el envío de los datos
            console.log('Textos completados:', textArray);


            // Validación de campos

            // Usar fetch para enviar los datos del formulario
            fetch('{{ route('textos.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    textos: textArray,
                    bloque_id: bloque_id
                })
            })
                .then(response => response.json())
                .then(data => {
                    // Verificar que la respuesta contiene textos

                    const contenedor = document.getElementById('addedTexts_' + bloque_id);

                    // Iterar sobre cada texto recibido y agregarlo a la interfaz
                    data.textos.forEach(texto => {
                        const newText = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="col-md-4 mb-4" id="texto_${texto.id}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="card mb-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="card-body">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h5 class="card-title">${texto.tipo}</h5>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <p class="card-text">${texto.contenido}</p>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- Formulario de eliminación con el ID dinámico de la respuesta -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <form action="/textos/destroy/${texto.id}" method="POST" style="display:inline;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="hidden" name="_token" value="${document.querySelector('input[name="_token"]').value}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="btn btn-danger" onclick="eliminarTexto(${texto.id})">Eliminar</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </form>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- Botón para Editar, abrir el modal con los datos del texto -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <button type="button" class="btn btn-warning" onclick="openEditModal(${texto.id})">Editar</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>`;

                        // Agregar el texto al contenedor
                        contenedor.innerHTML += newText;
                    });

                    // Limpiar el formulario después de agregar los textos
                    document.getElementById('textForm').reset();
                    $('#textModal').modal('hide');

                })
                .catch(error => {
                    console.error('Error al agregar el texto:', error);
                    alert('Hubo un error al agregar el texto.');
                });

        }
        function updateTextForm(textId) {
            const form = document.getElementById('textForm');
            const formData = new FormData(form);
            // Crear un campo _method para simular el método PUT


            // Enviar la actualización con AJAX
            fetch(`/texto/editar/${textId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Asegúrate de que el token esté disponible
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data) {

                        location.reload();
                    } else {
                        alert('Hubo un error al actualizar el texto');
                    }
                })
                .catch(error => console.error('Error al actualizar el texto:', error));
        }


        // Función para cerrar el modal
        function closeModal() {
            $('#textModal').modal('hide');
        }
    </script>

    <style>
        .image-option {
            border: 3px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .image-option.selected {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
        }

        .image-option img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .hidden-radio {
            display: none;
        }
    </style>


    <script>
        function handleTipoChange() {
            const tipoSelect = document.getElementById('tipo_bloque');  // Obtener el elemento select
            const selectedValue = tipoSelect.value;

            fetch(`/componentes/tipo/t/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const componenteSelect = document.getElementById('componente'); // El select donde se agregarán las opciones
                    componenteSelect.innerHTML = ''; // Limpiar las opciones previas

                    // Crear la opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Selecciona una plantilla';
                    componenteSelect.appendChild(defaultOption);

                    // Llenar el select con las opciones
                    data.forEach(plantilla => {
                        const option = document.createElement('option');
                        option.value = plantilla.id;
                        option.textContent = plantilla.nombre;
                        componenteSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar las plantillas:', error);
                    const componenteSelect = document.getElementById('componente');
                    componenteSelect.innerHTML = '<option class="text-danger" disabled>Error al cargar las plantillas.</option>';
                });
        }
        function guardarSeleccion() {
            const plantillaId = document.getElementById('plantilla').value;
            if (!plantillaId) {
                alert('Por favor, selecciona una plantilla.');
                return;
            }
            alert(`Plantilla seleccionada con ID: ${plantillaId}`);
        }
        function openTexturaModal(id) {
            const texturaFormAction = `/bloque/textura/asociar/${id}`;
            document.getElementById('TexturaForm').action = texturaFormAction;
            const bloque_id = document.getElementById('bloque_plantilla_id');
            bloque_id.value = id;
            fetch(`/componentes/textura`)
                .then(response => response.json())
                .then(data => {

                    const container = document.getElementById('texturas_container');
                    container.innerHTML = ''; // Limpia contenido anterior

                    data.forEach((textura, index) => {
                        const label = document.createElement('label');
                        label.style.display = 'inline-block';
                        label.style.margin = '10px';
                        label.style.cursor = 'pointer';

                        const radio = document.createElement('input');
                        radio.type = 'radio';
                        radio.name = 'textura'; // El name debe ser el mismo para todos los radios
                        radio.value = textura.id;
                        radio.style.display = 'none'; // Oculta el radio, sólo se verá la imagen

                        const img = document.createElement('img');
                        img.src = textura.ruta;
                        img.alt = 'Textura';
                        img.style.width = '150px';
                        img.style.height = '150px';
                        img.style.objectFit = 'cover';
                        img.style.border = '2px solid transparent';
                        img.style.borderRadius = '8px';
                        img.style.transition = 'border 0.3s';

                        // Cambia el borde al seleccionar
                        radio.addEventListener('change', () => {
                            // Quitar borde de todas las imágenes
                            document.querySelectorAll('#texturas_container img').forEach(i => {
                                i.style.border = '2px solid transparent';
                            });
                            // Agregar borde a la imagen seleccionada
                            img.style.border = '2px solid #007bff';
                        });

                        label.appendChild(radio);
                        label.appendChild(img);
                        container.appendChild(label);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar las texturas:', error);
                    document.getElementById('radioContainer').innerHTML =
                        '<p class="text-danger">Error al cargar las texturas.</p>';
                });
            $('#agregarTexturaModal').modal('show');
        }



        function openPlantillaModal(id) {
            const bloque_id = document.getElementById('bloque_plantilla_id');
            bloque_id.value = id;
            fetch(`/componentes/tipo/${id}`)
                .then(response => response.json())
                .then(data => {
                    const radioContainer = document.getElementById('radioContainer'); // Asegúrate de tener un div con este ID
                    radioContainer.innerHTML = ''; // Limpiar contenido previo

                    data.forEach(plantilla => {
                        const div = document.createElement('div');
                        div.classList.add('form-check');

                        const input = document.createElement('input');
                        input.type = 'radio';
                        input.classList.add('form-check-input');
                        input.name = 'plantilla';
                        input.value = plantilla.id;
                        input.id = `plantilla${plantilla.id}`;
                        input.setAttribute('onclick', 'seleccionarPlantilla(this)');
                        const label = document.createElement('label');
                        label.classList.add('form-check-label');
                        label.htmlFor = `plantilla${plantilla.id}`;
                        label.textContent = plantilla.nombre;

                        div.appendChild(input);
                        div.appendChild(label);
                        radioContainer.appendChild(div);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar las plantillas:', error);
                    document.getElementById('radioContainer').innerHTML = '<p class="text-danger">Error al cargar las plantillas.</p>';
                });
            $('#seleccionarPlantillaModal').modal('show');

        }



        function seleccionarPlantilla(radio) {
            const hiddenInput = document.getElementById('plantillaSeleccionada');
            hiddenInput.value = radio.value; // Guarda el ID seleccionado
            console.log('Plantilla seleccionada:', radio.value);
        }
        function openMultimediaModal(bloqueId) {
            // Rellenar el campo de bloque_id con el id del bloque
            document.getElementById('bloque_id_imagen').value = bloqueId;
            // Limpiar la previsualización
            document.getElementById('archivos').value = '';  // Limpiar el campo de archivos
            document.getElementById('previsualizacion').innerHTML = '';  // Limpiar la previsualización
            document.getElementById('boton_accion_imagen').setAttribute('onclick', `submitMultimediaForm(${bloqueId})`);
            // Abrir el modal
            $('#multimediaModal').modal('show');
        }
        // Función para manejar la previsualización de archivos multimedia
        document.getElementById('archivos').addEventListener('change', function (e) {
            const files = e.target.files;
            const previsualizacion = document.getElementById('previsualizacion');
            previsualizacion.innerHTML = '';  // Limpiar las previsualizaciones anteriores

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                // Previsualización de imagen
                if (file.type.startsWith('image/')) {
                    reader.onload = function () {
                        const img = document.createElement('img');
                        img.src = reader.result;
                        img.style.maxWidth = '100px';
                        img.style.margin = '5px';
                        previsualizacion.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }

                // Previsualización de video
                if (file.type.startsWith('video/')) {
                    reader.onload = function () {
                        const video = document.createElement('video');
                        video.src = reader.result;
                        video.controls = true;
                        video.style.maxWidth = '100px';
                        video.style.margin = '5px';
                        previsualizacion.appendChild(video);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Función para enviar el formulario con AJAX
        function submitMultimediaForm(bloqueId) {

            const form = document.getElementById('multimediaForm');
            const formData = new FormData(form);  // Recopila los datos del formulario, incluidos los archivos.

            const token = document.querySelector('input[name="_token"]').value;
            fetch('{{ route('multimedia.store') }}', {
                // fetch('/multimedia/crear', {
                method: 'POST',
                headers: {

                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {

                    document.getElementById('archivos').value = '';
                    document.getElementById('previsualizacion').innerHTML = '';

                    displayMediaContent(data, bloqueId);


                    $('#multimediaModal').modal('hide');

                })
                .catch(error => console.error('Error al añadir multimedia:', error));


        }


        function displayMediaContent(mediaArray, bloqueId) {
            const container = document.getElementById('addedMultimedia_' + bloqueId); // Contenedor dinámico

            mediaArray.forEach(media => {
                // Crear el contenedor de columna para Bootstrap
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-3'; // Clase Bootstrap para columnas y espaciado

                // Crear el contenedor para cada archivo multimedia
                const mediaItem = document.createElement('div');
                mediaItem.className = 'media-item position-relative';

                // Botón de eliminar
                const deleteButtonHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" aria-label="Eliminar">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                &times;
                                                                                                                                                                                                                                                                                                                                                                                                                                                            </button>`;

                // Contenido multimedia
                if (media.tipo === 'imagen') {
                    mediaItem.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                ${deleteButtonHTML}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <img src="/storage/${media.ruta}" alt="Imagen de multimedia" class="img-fluid rounded">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
                } else if (media.tipo === 'video') {
                    mediaItem.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                ${deleteButtonHTML}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <video controls class="img-fluid rounded w-100">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <source src="/storage/${media.ruta}" type="video/mp4">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Tu navegador no soporta videos.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                </video>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
                } else if (media.tipo === 'audio') {
                    mediaItem.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                ${deleteButtonHTML}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <audio controls class="w-100 mt-2">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <source src="/storage/${media.ruta}" type="audio/mpeg">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Tu navegador no soporta audio.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                </audio>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
                }

                // Agregar evento al botón de eliminar
                const deleteButton = mediaItem.querySelector('.btn');
                deleteButton.addEventListener('click', () => {
                    eliminarMultimedia(media.id, col);
                });

                // Añadir el contenedor multimedia a la columna
                col.appendChild(mediaItem);

                // Agregar la columna al contenedor principal
                container.appendChild(col);
            });
        }
        function eliminarMultimedia(id, mediaElement) {
            const token = document.querySelector('input[name="_token"]').value;
            fetch(`/multimedia/eliminar/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar el elemento de la cuadrícula
                        mediaElement.remove();

                    } else {
                        alert('Error al eliminar la multimedia.');
                    }
                })
                .catch(error => console.error('Error al eliminar multimedia:', error));
        }
    </script>

    <script type="module">
        import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector("#content"))
                .catch(error => console.error("Error al inicializar CKEditor:", error));
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {
            let bloquesContainer = document.getElementById('bloques-container');

            if (!bloquesContainer) {
                console.error("El contenedor de bloques no se encontró en el DOM.");
                return;
            }

            new Sortable(bloquesContainer, {
                animation: 150,
                ghostClass: 'bg-light',
                handle: '.drag-handle', // Solo permite arrastrar usando el ícono específico
                onEnd: function (evt) {
                    let orden = [];
                    document.querySelectorAll('.bloque-item').forEach((item, index) => {
                        orden.push({ id: item.dataset.id, posicion: index + 1 });
                    });

                    // Actualizar las posiciones de los bloques en la base de datos
                    fetch("{{ route('bloques.updatePosicion') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ orden: orden })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Actualizar las posiciones en el DOM
                                data.updatedPositions.forEach(position => {
                                    let posicionElement = document.getElementById(`posicion-bloque-${position.id}`);
                                    if (posicionElement) {
                                        posicionElement.innerHTML = `<strong>Posición:</strong> ${position.posicion}`;
                                    }
                                });
                            }
                        });
                }
            });
        });


    </script>

@endsection
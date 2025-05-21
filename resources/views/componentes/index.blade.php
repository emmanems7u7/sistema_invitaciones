@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Lista de Componentes</h1>

        <!-- Botón para abrir el modal de crear -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrear">
            Agregar Componente
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <form id="formCrearContenido" action="{{ route('contenidos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <input type="text" class="form-control" id="contenido" name="contenido" required
                            oninput="formatearPrimeraMayuscula(this)">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>

            </div>
            </form>
        </div>
        <script>
            function formatearPrimeraMayuscula(input) {
                let texto = input.value;
                input.value = texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
            }
        </script>


        <div class="card mt-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>

                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($componentes as $componente)
                            <tr>
                                <td>{{ $componente->nombre }}</td>
                                <td>{{ $componente->tipo }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar"
                                        onclick="editarComponente({{ $componente->id }})">
                                        Editar
                                    </button>

                                    <form action="{{ route('componentes.destroy', $componente->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearLabel">Agregar Componente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('componentes.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <label for="tipo" class="form-label">Tipo de componente</label>
                        <select class="form-select" id="tipo" name="tipo" required onchange="handleTipoChange()">
                            <option value="" selected disabled>Selecciona un tipo</option>
                            @foreach ($contenidos as $contenido)
                                <option value="{{ $contenido->identificador }}">{{ $contenido->contenido }}</option>
                            @endforeach


                        </select>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Componente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_id">



                        <label for="tipo" class="form-label">Tipo de componente</label>
                        <select class="form-select" id="tipo" name="tipo" required onchange="handleTipoChange()">
                            <option value="" selected disabled>Selecciona un tipo</option>
                            @foreach ($contenidos as $contenido)
                                <option value="{{ $contenido->identificador }}">{{ $contenido->contenido }}</option>
                            @endforeach

                        </select>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editarComponente(id) {
            fetch(`/componentes/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;

                    document.getElementById('edit_tipo').value = data.tipo;

                    document.getElementById('formEditar').action = `/componentes/${data.id}`;
                });
        }
    </script>
@endsection
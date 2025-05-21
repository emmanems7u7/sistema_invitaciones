@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Panel administrativo</div>

                    <div class="card-body">

                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editUserModal" data-id="">
                            Añadir Usuario Cliente
                        </button>

                        <a href="{{ route('componentes.index') }} " class="btn btn-warning btn-sm">Añadir Componentes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">Clientes</div>

                    <div class="card-body">
                        <div class="container">
                            <h1>clientes</h1>

                            @if($clientes->isEmpty())
                                <p>No hay usuarios con el rol de "Cliente".</p>
                            @else
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo Electrónico</th>
                                            <th>Celular</th>

                                            <th>Fecha de Creación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $cliente)
                                            <tr>
                                                <td>{{ $cliente->name }}</td>
                                                <td>{{ $cliente->email }}</td>
                                                <td>
                                                    @if ($cliente->celulares->isNotEmpty())
                                                        @foreach ($cliente->celulares as $celular)
                                                            <p>Celular: {{ $celular->celular }}
                                                                - WhatsApp: {{ $celular->whatsapp ? 'Sí' : 'No' }}</p>
                                                        @endforeach
                                                    @else
                                                        <p>No hay celulares asociados.</p>
                                                    @endif
                                                </td>
                                                <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <a href=" {{route('crear_invitacion', ['id' => $cliente->id])}} "
                                                        class="btn btn-info btn-sm">Crear
                                                        Invitacion</a>
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal" data-id="{{ $cliente->id }}">
                                                        Editar
                                                    </button>
                                                    <form action="{{ route('users.destroy', $cliente->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para crear o editar usuario -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Crear o Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" id="editUserForm">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <!-- Campo para el celular -->
                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular">
                        </div>

                        <!-- Checkbox para WhatsApp -->
                        <div class="mb-3 form-check">
                            <!-- Campo oculto que se envía si el checkbox no está marcado -->
                            <input type="hidden" name="whatsapp" value="0">

                            <!-- Checkbox -->
                            <input type="checkbox" class="form-check-input" id="whatsapp" name="whatsapp" value="1">
                            <label class="form-check-label" for="whatsapp">Es número de WhatsApp</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        // Función para cargar los datos del usuario al modal
        function loadUserData(userId) {
            fetch(`/users/${userId}/data`) // Usamos Fetch API en lugar de jQuery
                .then(response => response.json())
                .then(data => {
                    // Llenar los campos del modal con los datos del usuario
                    document.getElementById('name').value = data.name;
                    document.getElementById('email').value = data.email;
                    document.getElementById('celular').value = data.celular;

                    // Marcar el checkbox de WhatsApp si el valor es verdadero
                    document.getElementById('whatsapp').checked = data.whatsapp;

                    // Cambiar la URL del formulario para que apunte a la actualización del usuario
                    const formAction = '{{ route('users.update', parameters: ':userId') }}'.replace(':userId', userId);
                    document.getElementById('editUserForm').setAttribute('action', formAction);
                    document.getElementById('editUserForm').setAttribute('method', 'POST');
                    let inputMethod = document.createElement('input');
                    inputMethod.setAttribute('name', '_method');
                    inputMethod.setAttribute('value', 'PUT');
                    inputMethod.setAttribute('type', 'hidden');
                    document.getElementById('editUserForm').appendChild(inputMethod);
                })
                .catch(error => {
                    console.error('Error al cargar los datos del usuario:', error);
                    alert('Error al cargar los datos del usuario.');
                });
        }

        // Asignamos la función al evento de abrir el modal
        const modal = document.getElementById('editUserModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // El botón que activó el modal
            const userId = button.getAttribute('data-id'); // Obtener el ID del usuario

            if (userId) {
                // Si hay un ID de usuario, es para editar
                loadUserData(userId);
            } else {
                // Si no hay un ID, es para crear un nuevo usuario
                // Limpiar los campos y dejar el formulario preparado para crear
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';

                // Cambiar la acción del formulario para crear un usuario
                const formAction = '{{ route('users.store') }}';
                document.getElementById('editUserForm').setAttribute('action', formAction);
                let inputMethod = document.createElement('input');
                inputMethod.setAttribute('name', '_method');
                inputMethod.setAttribute('value', 'POST');
                inputMethod.setAttribute('type', 'hidden');
                document.getElementById('editUserForm').appendChild(inputMethod);
            }
        });
    </script>
@endsection
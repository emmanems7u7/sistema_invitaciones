<h2>Invitados</h2>

@if($invitados->isEmpty())
    <p>No hay invitados para esta invitación.</p>
@else
    <div class="table-responsive p-1 small">
        <table class="table table-sm table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <td class="bg-primary"><a href="{{ route('invitados.export', $id) }}" class="text-white"
                            target="_blank"> Exportar Excel</a></td>
                    <td class="bg-primary"><a href="{{ route('invitados.export_data', $id) }}" class="text-white"
                            target="_blank"> Exportar para enviar invitacion</a></td>
                    <td colspan="2" class="bg-primary"><a href="{{ route('invitados.email', $id) }}" class="text-white"
                            target="_blank"> Enviar Invitación por email</a></td>

                </tr>
                <tr>
                    <th style="width: 140px;">Nombre</th>
                    <th style="width: 70px;">Asist.</th>
                    <th style="width: 150px;">Email</th>
                    <th style="width: 100px;">Celular</th>
                    <th style="width: 100px;">Enlace</th>
                    <th style="width: 70px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invitados as $invitado)
                    <tr>
                        <td class="text-truncate">{{ $invitado->nombre_completo }}</td>
                        <td class="text-center align-middle {{ $invitado->asistencia == 1 ? 'bg-success' : 'bg-dark' }}">
                            <i class="fas {{ $invitado->asistencia == 1 ? 'fa-check text-white' : 'fa-times text-white' }}"></i>
                        </td>
                        <td class="text-truncate">
                            {{ $invitado->email }}
                        </td>
                        <td>{{ $invitado->celular }}</td>
                        <td>
                            <a href="{{ $invitado->enlace }}" target="_blank">{{ $invitado->enlace }}</a>
                        </td>

                        <td>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('invitados.destroy', $invitado->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay invitados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endif
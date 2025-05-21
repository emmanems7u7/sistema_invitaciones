<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        border: 1px solid #999;
        padding: 8px;
        text-align: left;
        vertical-align: middle;
    }

    thead {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    th:nth-child(1) {
        width: 30%;
    }

    th:nth-child(2) {
        width: 10%;
        text-align: center;
    }

    th:nth-child(3) {
        width: 25%;
    }

    th:nth-child(4) {
        width: 15%;
    }

    th:nth-child(5) {
        width: 20%;
        word-break: break-all;
    }
</style>

<h2 style="margin-bottom: 0;">Lista de Invitados</h2>
<p style="margin-top: 4px;">Invitación: {{ $nombre_invitacion ?? 'Sin nombre' }}</p>
<p>Fecha de exportación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th style="width: 200px; border: 1px solid #000; padding: 5px; background-color: #f2f2f2;">Nombre</th>
            <th style="width: 100px; border: 1px solid #000; padding: 5px; background-color: #f2f2f2;">Asistencia</th>
            <th style="width: 150px; border: 1px solid #000; padding: 5px; background-color: #f2f2f2;">Email</th>
            <th style="width: 120px; border: 1px solid #000; padding: 5px; background-color: #f2f2f2;">Celular</th>
            <th style="width: 400px; border: 1px solid #000; padding: 5px; background-color: #f2f2f2;">Enlace</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($invitados as $invitado)
            <tr>
                <td>{{ $invitado->nombre_completo }}</td>
                <td style="text-align: center;">{{ $invitado->asistencia == 1 ? 'Confirmado' : 'No Confirmó' }}</td>
                <td>{{ $invitado->email }}</td>
                <td>{{ $invitado->celular }}</td>
                <td>{{ $invitado->enlace }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
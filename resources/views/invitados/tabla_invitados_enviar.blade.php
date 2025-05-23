<table>

    <tbody>
        @foreach ($invitados as $invitado)
            <tr>
                <td>{{ $invitado->nombre_completo }}</td>
                <td>{{ $invitado->celular }}</td>
                <td>{{ $invitado->enlace }}</td>
            </tr>
        @endforeach
    </tbody>
</table>